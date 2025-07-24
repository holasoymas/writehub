<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;
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

    Route::resource('posts', PostController::class)->except(['show']);

    Route::post('/comment/create', [CommentController::class, "create"]);
});

// use it at last to prevent route shadowing
Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::post('posts/uploadImage', [PostController::class, 'uploadImage'])->name('uploadImage');
Route::post('posts/ploadImageUrl', [PostController::class, 'ploadImageUrl'])->name('uploadImageUrl');
