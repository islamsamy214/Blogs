<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;

//don't forget it has an admin prefix

Route::group(['middleware' => 'auth'], function () {
    //to check user in front-end
    Route::get('user', function () {
        return auth()->user();
    });

    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index']);

    //users
    Route::resource('users', UserController::class)->except(['show', 'create']);

    //clients
    Route::resource('clients', ClientController::class)->except(['show', 'create']);

    //settings
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    //categories
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);

    //posts
    Route::resource('posts', PostController::class);

    //comments
    Route::resource('comments', CommentController::class)->except(['show', 'create']);
});

//settings
Route::get('settings', [SettingController::class, 'retreve'])->name('settings.retreve');
