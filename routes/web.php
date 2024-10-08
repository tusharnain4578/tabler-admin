<?php

use Illuminate\Support\Facades\Route;




Route::prefix('admin')->name('admin.')->group(function () {
    require_once 'admin.php';
});
