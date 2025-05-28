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
    $relatedposts = Post::where('is_published', true)
                    ->where('id', '!=', $post->id)
                    ->whereHas('tags', function ($query) use ($post) {
                        $query->whereIn('tags.id', $post->tags->pluck('id'));
                    })
                    ->limit(4)
                    ->get();
    //return $relatedposts;
    return view('post', compact('post', 'relatedposts'));
}


   
/*
public function prueba() {
    return view('prueba');
   }*/

}
