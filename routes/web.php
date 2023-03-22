<?php
///////////////////imports//////////////////////////////////
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as ClientLoginController;
use App\Http\Controllers\Auth\RegisterController as ClientRegisterController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
///////////////////admin routes//////////////////////////
// Auth
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout']);
Route::post('/admin/register', [AdminRegisterController::class, 'register']);
///////////////////web routes///////////////////////////
// Auth
Route::post('/login', [ClientLoginController::class, 'login']);
Route::post('/logout', [ClientLoginController::class, 'logout']);
Route::post('/register', [ClientRegisterController::class, 'register']);

///////////////////SPA routes//////////////////////////
Route::get(
    '/{any?}',
    function () {
        return view('index');
    }
)->where('any', '^(?!api\/)[\/\w\.\,-]*');
