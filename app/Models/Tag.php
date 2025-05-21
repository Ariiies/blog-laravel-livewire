<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    // Define the relationship with the Post model
    // This assumes that a tag can have many posts
    // and a post can have many tags
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
