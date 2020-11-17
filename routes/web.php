<?php

use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

Route::get('/{path}', [SpaController::class, 'index'])->where('path', '^((?!api).)*$');
