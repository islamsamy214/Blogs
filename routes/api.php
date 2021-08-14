<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

Route::group(['middleware' => 'auth:clients'], function () {
    //to check user in front-end
    Route::get('client', function () {
        return auth()->guard('clients')->user();
    });

    //posts
    Route::resource('posts', PostController::class)->only(['index', 'show']);

    //comments
    Route::resource('comments', CommentController::class)->except(['index', 'show', 'create']);
});

//home
Route::get('home', [HomeController::class, 'index'])->name('home');

//about
Route::get('about', [AboutController::class, 'index'])->name('about');
