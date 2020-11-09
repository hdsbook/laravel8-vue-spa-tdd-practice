<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'role.check:admin'])->get('/role', function () {
    echo 'authorized!';
});

Route::get('unauthorized', function () {
    abort(403, 'Unauthorized action.');
});

Route::prefix('api')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('fetch', [NewsController::class, 'fetchNews'])->name('news.fetch');
        Route::get('find', [NewsController::class, 'fetchNewsById'])->name('news.find');
    });
    Route::resource('news', NewsController::class)->only(['store', 'update', 'destroy']);
});

Route::get('/{path}', [SpaController::class, 'index'])
    ->where('path', '^((?!api).)*$');
