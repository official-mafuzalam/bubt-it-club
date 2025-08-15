<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Scope a query to only include categories with published posts.
     */
    public function scopeWithPublishedPosts(Builder $query): void
    {
        $query->whereHas('posts', function ($q) {
            $q->published();
        });
    }

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_category');
    }
}