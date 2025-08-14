<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'student_id',
        'intake',
        'section',
        'department',
        'payment_method',
        'transaction_id',
        'additional_info',
        'attended'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'attended' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the event that owns the registration.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user that made the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include attended registrations.
     */
    public function scopeAttended($query)
    {
        return $query->where('attended', true);
    }

    /**
     * Scope a query to only include registrations for a specific event.
     */
    public function scopeForEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Get the registration's department name.
     */
    public function getDepartmentNameAttribute()
    {
        return match ($this->department) {
            'CSE' => 'Computer Science & Engineering',
            'EEE' => 'Electrical & Electronic Engineering',
            'BBA' => 'Business Administration',
            'MBA' => 'Masters of Business Administration',
            default => $this->department,
        };
    }

    /**
     * Mark the registration as attended.
     */
    public function markAsAttended()
    {
        $this->update(['attended' => true]);
        return $this;
    }
}