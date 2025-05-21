<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'body',
        'category_id',
        'user_id',
        'excerpt',
        'is_published',
        'published_at'
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // Define the relationship with the User model
    // This assumes that a post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with the Category model
    // This assumes that a post belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Define the relationship with the Tag model
    // This assumes that a post can have many tags
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    // Define the relationship with the Comment model
    // This assumes that a post can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
