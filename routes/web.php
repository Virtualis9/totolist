<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $cars = [
        'mercedes' => 'amg',
        'audi' => 'a4',
        'bmw' => 'x5'
    ];

    return Inertia::render('Welcome', [
        'cars' => $cars
    ]);
})->name('welcome');


Route::get('/hallo', function () {
    return redirect()->route('welcome');
});

Route::fallback(function () {
    return redirect()->route('welcome');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
