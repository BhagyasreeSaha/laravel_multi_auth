<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // This page will show dashboard page for admin
    public function index() {
        return view('admin.dashboard');
    }
}
