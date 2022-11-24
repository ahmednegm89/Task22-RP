<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\PermissionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('setlang')->group(function () {
    Route::middleware('auth')->prefix('user')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('user.index');
        Route::get('/profile', [HomeController::class, 'show'])->name('user.show');
        Route::post('/profile/update/{id}', [HomeController::class, 'update'])->name('user.update');
    });

    Route::middleware('auth', 'admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard.dashboard');
        });
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/hlogin', [AuthController::class, 'hlogin'])->name('auth.hlogin');

    Route::get('/lang/en', [LangController::class, 'en'])->name('lang.en');
    Route::get('/lang/ar', [LangController::class, 'ar'])->name('lang.ar');
});
