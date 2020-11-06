<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum', 'verified'])->get('/jet', function () {
//     return view('dashboard');
// });

Route::get('/home', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'role.check:admin'])->get('/role', function () {
    echo 'authorized!';
});

Route::get('unauthorized', function () {
    abort(403, 'Unauthorized action.');
});

// Route::get('/', [HomeController::class, 'index']);

// Route::get('news', [NewsController::class, 'index'])->name('news.index');

Route::get('/{path}', function () {
    return view('spa');
})->where('path', '^((?!api).)*$');
