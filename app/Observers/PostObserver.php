<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function updating(Post $post)
    {
        // Si is_published es verdadero y published_at no está establecido, usar now()
        if ($post->is_published && is_null($post->published_at)) {
            $post->published_at = now();
        } elseif (!$post->is_published) {
            // Si is_published es falso, establecer published_at como null
            $post->published_at = null;
        }
        // Si published_at ya tiene un valor y is_published es verdadero, no hacer nada
    }
}