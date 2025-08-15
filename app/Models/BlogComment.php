<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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