<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * RedirectController
 */
class RedirectController extends \App\Foundation\Controller
{
    public function rootToAdminDashboard()
    {
        return redirect()->route('admin.home');
    }
}
