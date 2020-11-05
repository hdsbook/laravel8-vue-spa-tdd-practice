<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum', 'verified'])->get('/jet', function () {
//     return view('dashboard');
// });

Route::get('/home', function () {
    return view('welcome');
});

Route::get('unauthorized', function () {
    abort(403, 'Unauthorized action.');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
