<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\Post;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Models\User;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('post/{post}', [HomeController::class, 'show'])
    ->name('post.show');

Route::get('profile', [HomeController::class, 'profile'])
    ->name('profile');



Route::get('test', [TestController::class, 'index'])
    ->name('test');

Route::get('test/prueba', [TestController::class, 'preba'])
    ->name('test.prueba');
/*
Route::get('superuser', function () {

    $user = User::find(1);
    $roles = ['admin'];
     $user->syncRoles($roles);
    return redirect()->route('home');

})->name('super.user');
*/
/*
Route::get('/', function () {
    $posts = Post::where('is_published', true)
                     ->whereNotNull('published_at')
                     ->latest('published_at')
                     ->paginate(12);
    return view('welcome', compact('posts'));
})->name('home');

Route::get('post/{post}', function (Post $post) {
   
    return view('post', compact('post'));
})->name('post.show');
*/
/* Ruta innecesaria
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
*/
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
//require __DIR__.'/admin.php';