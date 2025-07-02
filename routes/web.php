<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;
use App\Models\UserFollow;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, "create"])->name("login");
Route::post('login', [LoginController::class, "store"])->name("login.store");

Route::resource('user', UserController::class)->only([
    'create',
    'store',
    'show'
])->names("user");

// adding protection to route
Route::middleware(["auth"])->group(function () {
    Route::resource('user', UserController::class)->except(['create', 'store', 'show']);

    Route::post('/follow/{user}', [UserFollowController::class, 'follow'])->name('user.follow');
    Route::delete('/unfollow/{user}', [UserFollowController::class, 'unfollow'])->name('user.unfollow');
});
