<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'author_id',
        'featured_image',
        'is_published',
        'published_at',
        'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function author()
    {
        return $this->belongsTo(Member::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class)->where('is_approved', true);
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200); // 200 words per minute
    }
}

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class);
    }
}

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id',
        'member_id',
        'name',
        'email',
        'content',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}