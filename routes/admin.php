<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Enums\Permission;





Route::controller(AuthController::class)->name('auth.')->group(function () {

    Route::middleware('guest:admin')->group(function () {

        Route::get('login', 'login')->name('login');

        Route::post('login', 'handleLogin')->name('handle-login');

    });

    Route::post('logout', 'handleLogout')->name('handle-logout');

});




Route::middleware(['auth:admin', 'permission:' . Permission::ADMIN_PANEL])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('permissions', PermissionController::class)->except('create', 'store', 'destroy');

    Route::resource('roles', RoleController::class);

    Route::resource('admins', AdminController::class);

    Route::resource('users', UserController::class)->except('edit', 'update');

});


