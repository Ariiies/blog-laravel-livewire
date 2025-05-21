<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;

Route::get('/',[AdminController::class, 'index'])->name('admin.dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);

