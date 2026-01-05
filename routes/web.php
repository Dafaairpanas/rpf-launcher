<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ApplicationController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.applications.index'));
    Route::resource('applications', AdminApplicationController::class)->except(['show']);

    // Hanya superadmin yang bisa akses roles dan users
    Route::middleware('superadmin')->group(function () {
        Route::resource('roles', AdminRoleController::class)->except(['show']);
        Route::resource('users', AdminUserController::class)->except(['show']);
    });
});


