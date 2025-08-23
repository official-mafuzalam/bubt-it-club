<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true)
              ->whereNotNull('published_at')
              ->where('published_at', '<=', now());
    }

    public function getCoverImageAttribute()
    {
        return $this->images->first();
    }
}