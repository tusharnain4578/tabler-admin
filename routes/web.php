<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

Route::prefix('admin')->name('admin.')->group(function () {
    require_once 'admin.php';
});

// I made separate redirect controller, beecause closures in routes don't get cached

Route::get('/', [RedirectController::class, 'rootToAdminDashboard']);
