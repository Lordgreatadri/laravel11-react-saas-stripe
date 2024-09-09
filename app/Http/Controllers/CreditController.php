<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\FeatureResource;
use App\Models\Feature;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PackageResource;

class CreditController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $features = Feature::where("active", true)->get();

        return Inertia::render('Credit/Index', [
            'packages' => PackageResource::collection($packages),
            'features' => FeatureResource::collection($features),
            'success' => session('success'),
            "error" => session('error'),
        ]);

        
    }

    public function purchaseCredits(Package $package) {
        try 
        {
            Log::info($package);
            $stripe = new \Stripe\StripeClient(env("STRIPE_KEY"));
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $package->name.' - '.$package->credits.' credits',
                            ],
                            'unit_amount' => $package->price * 100,
                        ],
                        'quantity' => 1,
                    ],
                    'mode' => 'payment',
                    'success_url' => route('credit.success', [], true),
                    'cancel_url' => route('credit.cancelled', [], true),
                ],
                'metadata' => [
                    'package_id' => $package->id,
                ],
            ]);
 
            Trananction::create([
                'user_id' => auth()->user()->id,
                'status' => 'pending',
                'package_id' => $package->id,
                'price' => $package->price,
                'credits' => $package->credits,
                'session_id' => $session->id,
            ]);

            return redirect($session->url);
        }catch(Exception $e)
        {
            Log::info($e);
            return redirect()->back()->with('error', 'An error occurred while processing your payment.');
        } catch (\Stripe\Exception\InvalidArgumentException $th) {
            Log::info($th);
            return redirect()->back()->with('error', 'Invalid request argument passed.');
        }catch (\Stripe\Exception\AuthenticationException $ex) {
            Log::info($ex);
            return redirect()->back()->with('error', 'Invalid Api Key Provided.');
        }
        
    }


    public function purchaseSuccess() {
        return to_route('credit.index')->with('success', 'New credits bought successfully.');
    }



    public function purchaseCancelled() {
        return to_route('credit.index')->with('error', 'There was an error in the payment process. Please try again later.');
    }


    public function webHook() {
        $endpoint_secret = env("STRIPE_WEBHOOK_SECRET");#your CLI webhook secret key for testing local endpoint
        $payload = file_get_contents('php://input');

        Log::info($payload);

        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $ex) {
            Log::info($ex);
            return response('', 400); //Invalid payload
        }catch (\Stripe\Exception\SignatureVerificationException $ex) {
            Log::info($ex);
            return response('', 400); //Invalid signature
        }

        //Let's handle the events here...
        switch ($event->type) {
            case "checkout.session.completed":
                $session = $event->data->object;
                $transaction = Transaction::where('session_id', $session->id)->first();
                if($transaction && $transaction->status === 'pending') {
                    $transaction->status = 'paid';
                    $transaction->save();

                    $transaction->user->available_credits += $transaction->credits;
                    $transaction->user->save();
                }
                //other event types
            default:
            echo "Unknown event type " . $event->type;    
        }

        return response('', 200); 
    }
}
