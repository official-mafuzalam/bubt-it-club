<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'start_date',
        'end_date',
        'location',
        'image_url',
        'category',
        'is_published',
        'is_registration_open',
        'is_paid',
        'max_participants',
        'registered_count'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getRemainingSeatsAttribute()
    {
        if (!$this->max_participants)
            return null;
        return $this->max_participants - $this->registrations()->count();
    }

    public function getStatusAttribute()
    {
        if ($this->start_date > now()) {
            return 'Upcoming';
        } elseif ($this->start_date <= now() && $this->end_date >= now()) {
            return 'Ongoing';
        } else {
            return 'Completed';
        }
    }
}