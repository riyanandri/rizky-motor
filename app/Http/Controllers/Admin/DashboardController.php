<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function superAdmin()
    {
        return view('dashboard-admin');
    }

    public function kasir()
    {
        return view('dashboard-kasir');
    }
}
