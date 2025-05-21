<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){

        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function roles()
    {
        return view('admin.roles');
    }
    
}
