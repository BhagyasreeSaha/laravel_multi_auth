<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'],function(){

    //guest middleware
    Route::group(['middleware' => 'guest'],function() {
        Route::get('login',[LoginController::class, 'index'])->name('account.login');
        Route::get('register',[LoginController::class, 'register'])->name('account.register');
        Route::post('process-register',[LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate',[LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    //authenticated middleware
    Route::group(['middleware' => 'auth'],function() {
        Route::get('logout',[LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class, 'index'])->name('account.dashboard');
    });
});

Route::group(['prefix' => 'admin'],function(){

    //guest middleware for admin
    Route::group(['middleware' => 'admin.guest'],function() {
        Route::get('login',[AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    //authenticated middleware for admin
    Route::group(['middleware' => 'admin.auth'],function() {
        Route::get('dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class, 'logout'])->name('admin.logout');
    });
});

// Route::get('/admin/login',[AdminLoginController::class, 'index'])->name('admin.login');
// Route::post('/admin/authenticate',[AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
// Route::get('/admin/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
// Route::get('/admin/logout',[AdminLoginController::class, 'logout'])->name('admin.logout');