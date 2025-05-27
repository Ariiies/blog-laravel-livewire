<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts\PostDetail;
use App\Livewire\Posts\CreatePost;
use App\Livewire\Posts\EditPost;

Route::get('create/post', CreatePost::class)
    ->name('post.create'); // Usando el componente Livewire para mostrar el formulario de creación de post

Route::get('/post/{slug}', PostDetail::class)
    ->name('post.show'); // Using Livewire component to show a post

Route::get('post/{slug}/edit', EditPost::class)
    ->name('post.edit'); // Using Livewire component to edit a post