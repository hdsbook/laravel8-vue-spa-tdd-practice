<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'fetchAuthUser']);

// news
Route::prefix('news')->group(function () {
    Route::get('fetch/{perPage}', [NewsController::class, 'fetchNews'])->name('news.fetch');
    Route::get('find', [NewsController::class, 'fetchNewsById'])->name('news.find');
});
Route::resource('news', NewsController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('auth:sanctum');
