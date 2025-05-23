<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\PostObserver;

#[ObservedBy(PostObserver::class)]

class Post extends Model
{
    use HasFactory;
    
    // En tu modelo Post.php:
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (filter_var($model->is_published, FILTER_VALIDATE_BOOLEAN)) {
                $model->published_at = $model->published_at ?? now();
            } else {
                $model->published_at = null;
            }
        });
    }

    // para la ruta de slug
    public function getRouteKeyName(){
        return 'slug'; // esto permite que la ruta use el slug en vez del id
    }
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
        'is_published' => 'boolean',
        'published_at' => 'datetime',
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
    public function tags()
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
