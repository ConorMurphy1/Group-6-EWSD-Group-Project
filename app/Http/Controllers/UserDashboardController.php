<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function posts()
    {
        // dd()
        return view('userpanel.layout.app');
    }
}
