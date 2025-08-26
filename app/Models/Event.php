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
        'only_for_members',
        'max_participants',
        'registered_count'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'only_for_members' => 'boolean'
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

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())->where('end_date', '>=', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('end_date', '<', now());
    }
}