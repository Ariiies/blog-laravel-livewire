<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard')->middleware('can:access dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);

Route::resource('permissions', PermissionController::class);

Route::resource('roles', RoleController::class);

Route::resource('users', UserController::class);

