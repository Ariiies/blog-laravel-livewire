<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
   public function index () {
    $posts = Post::where('is_published', true)
                     ->whereNotNull('published_at')
                     ->latest('published_at')
                     ->paginate(12);
    return view('welcome', compact('posts'));
   }

public function show (Post $post) {
   
    return view('post', compact('post'));
}

}
