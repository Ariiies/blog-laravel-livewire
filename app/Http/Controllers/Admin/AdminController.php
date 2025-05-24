<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [Middleware::class => ['auth', 'can:access dashboard']];
    }

    /**
     * Display a listing of the resource.
     */

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
