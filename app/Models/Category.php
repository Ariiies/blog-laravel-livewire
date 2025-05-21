<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name'
        
    ];

    // Define the relationship with the Post model
    // This assumes that a category can have many posts
    // and a post belongs to one category
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
