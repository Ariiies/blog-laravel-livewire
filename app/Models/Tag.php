<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    // Define the relationship with the Post model
    // This assumes that a tag can have many posts
    // and a post can have many tags
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
