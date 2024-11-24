<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'excerpt',
        'image',
        'published',
        'published_at',
        'category_id'
    ];




    /**
     * Get the user who authored the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories that belong to the post.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}