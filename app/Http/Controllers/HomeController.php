<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\FeatureResource;

class HomeController extends Controller
{
    public function index() {
        $features = Feature::query()->where('active', true)->get();

        return Inertia::render('Home', [
            'features' => FeatureResource::collection($features),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);


    }
}
