<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class)->only([
    'create',
    'store',
    'show'
])->names("user");

// adding protection to route
Route::middleware(["auth"])->group(function () {
    Route::resource('user', UserController::class)->except(['create', 'store', 'show']);
});
