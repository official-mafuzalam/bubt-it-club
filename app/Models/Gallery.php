<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'event_id',
        'date',
        'is_active',
        'cover_image_url'
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }
}

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'image_url',
        'caption',
        'order'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}