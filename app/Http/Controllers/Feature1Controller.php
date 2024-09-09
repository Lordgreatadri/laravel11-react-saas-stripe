<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Feature;
use App\Models\UsedFeature;
use Illuminate\Http\Request;
use App\Http\Resources\FeatureResource;

class Feature1Controller extends Controller
{
    public ?Feature $feature = null;

    public function __construct() {
        $this->feature = Feature::where("route_name", "feature1.index")
            ->where("active", "true")
            ->firstOrFail();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Feature1/Index", [
            "feature" => new FeatureResource($this->feature),
            "answer"  => session("answer"),
        ]);
    }

    
    public function calculate(Request $request) {
        $user = $request->user();

        if($user->available_credits < $this->feature->required_credits) {
            return back();
        }

        $data = $request->validate([
            "number1" => ["required", "numeric"],
            "number2" => ["required", "numeric"],
            // "operator" => ["required", "in:add,subtract,multiply,divide"],
        ]);

        $number1 = (float) $data["number1"];
        $number2 = (float) $data["number2"];

        $user->decreaseCredits($this->feature->required_credits);

        UsedFeature::create([
            "user_id" => $user->id,
            "feature_id" => $this->feature->id,
            "credits" => $this->feature->required_credits,
            "data" => $data,
        ]);

        return to_route("feature1.index")->with(["answer"=>$number1 + $number2]);
    }

    
}
