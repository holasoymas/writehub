<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowersList;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FeedController::class, 'show'])->name('home');

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

    Route::post('/like', [LikeController::class, 'toggleLike']);

    Route::post('/bookmark', [BookmarkController::class, 'toggleBookMark']);

    Route::post('/report', [ReportController::class, 'report'])->name('post.report');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// use it at last to prevent route shadowing
Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::post('posts/uploadImage', [PostController::class, 'uploadImage'])->name('uploadImage');
Route::post('posts/ploadImageUrl', [PostController::class, 'ploadImageUrl'])->name('uploadImageUrl');

Route::get('user/{id}/followers', [FollowersList::class, 'followers'])->name('followers');
Route::get('user/{id}/followings', [FollowersList::class, 'followings'])->name('followings');

Route::get('/search', [SearchController::class, 'search']);

// for oauth
Route::get('/auth/{provider}/redirect', [OauthController::class, 'redirect'])->name('oauth.redirect');
Route::get('/auth/{provider}/callback', [OauthController::class, 'callback'])->name('oauth.callback');

// for forget password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->middleware('guest')->name('password.email');

Route::get('/forgot-password/email-send/success', [ForgotPasswordController::class, 'showSuccessReset'])->middleware('guest')->name('password.email.send');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');
