<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\Feature1Controller;
use App\Http\Controllers\Feature2Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/feature1', [Feature1Controller::class, "index"])->name('feature1.index');
    Route::post('/feature1', [Feature1Controller::class, "calculate"])->name('feature1.calculate');

    Route::get('/feature2', [Feature2Controller::class, "index"])->name('feature2.index');
    Route::post('/feature2/calculate', [Feature2Controller::class, "calculate"])->name('feature2.calculate');

    Route::get('/credit', [CreditController::class, "index"])->name('credit.index');
    Route::post('/credit/purchase/{package}', [CreditController::class, "purchaseCredits"])->name('credit.purchase');
    Route::get('/credit/success', [CreditController::class, "purchaseSuccess"])->name('credit.success');
    Route::get('/credit/cancelled', [CreditController::class, "purchaseCancelled"])->name('credit.cancelled');
});

Route::post('/credit/webhook', [CreditController::class, "webHook"])->name('credit.webhook');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
