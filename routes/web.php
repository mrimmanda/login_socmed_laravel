<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/
Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register');
    Route::post('/storeRegister', [RegisterController::class, 'storeRegister'])->name('storeRegister');
});

/*
|--------------------------------------------------------------------------
| Logout (AUTH)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Guest routes (BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::prefix('register')->group(function () {
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/store', [RegisterController::class, 'storeRegister'])->name('register.store');
    });

});

/*
|--------------------------------------------------------------------------
| Auth routes (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
