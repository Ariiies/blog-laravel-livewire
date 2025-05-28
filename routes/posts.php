<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts\PostDetail;
use App\Livewire\Posts\CreatePost;
use App\Livewire\Posts\EditPost;
use App\Livewire\Posts\PostsUser;
use App\Livewire\Posts\ProfileUser;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

Route::get('create/post', CreatePost::class)
    ->name('post.create'); // Usando el componente Livewire para mostrar el formulario de creación de post


Route::get('post/{slug}/edit', EditPost::class)
    ->name('post.edit'); // Using Livewire component to edit a post

Route::get('user/user_id/posts', PostsUser::class)
    ->name('user.posts');


Route::get('user/{id}', ProfileUser::class)
    ->name('user.profile');

Route::delete('user/delete/post/{post}', function (Post $post) {
    if ($post->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    if ($post->image_path) {
            Storage::delete($post->image_path);
        }
        $post->delete();
        session()->flash('swal', ['icon' => 'success', 'title' => 'Post deleted successfully.']);
    return redirect()->route('user.posts');
})->name('user.delete.post'); // Route to delete a post by the user