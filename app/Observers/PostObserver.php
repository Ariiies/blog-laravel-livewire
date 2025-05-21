<?php

namespace App\Observers;
use App\Models\Post;

class PostObserver
{
    public function updating(Post $post){
        // Code to execute before creating a post
        if (!empty($data['is_published']) && $post['is_published']) {
            $post['published_at'] = now();
        } else {
            $post['published_at'] = null;
        }

    }
}
