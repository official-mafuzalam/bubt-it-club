<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthdate',
        'password',
        'student_id',
        'department',
        'intake',
        'gender',
        'position',
        'executive_committee_id',
        'bio',
        'photo_url',
        'social_links',
        'favorite_categories',
        'is_active',
        'contact_public',
        'social_links_public',
        'joined_at',
        'is_verified'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'social_links' => 'array',
        'favorite_categories' => 'array',
        'joined_at' => 'date',
        'is_active' => 'boolean',
        'contact_public' => 'boolean',
        'social_links_public' => 'boolean',
        'password' => 'hashed',
    ];

    protected $hidden = ['password', 'remember_token'];

    /**
     * A member can have many membership payments.
     */
    public function payments()
    {
        return $this->hasMany(MembershipPayment::class, 'member_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class, 'student_id', 'student_id');
    }

    public function attendedEvents()
    {
        return $this->hasManyThrough(
            Event::class,
            EventRegistration::class,
            'student_id',      // Foreign key on event_registrations table
            'id',              // Foreign key on events table
            'student_id',      // Local key on members table
            'event_id'         // Local key on event_registrations table
        );
    }


    /**
     * Get the member's contact visibility.
     */
    public function getContactVisibilityAttribute()
    {
        return $this->contact_public ? 'Public' : 'Private';
    }

    /**
     * Get the member's social links visibility.
     */
    public function getSocialLinksVisibilityAttribute()
    {
        return $this->social_links_public ? 'Public' : 'Private';
    }

    /**
     * Get the executive committee that the member belongs to.
     */
    public function executiveCommittee()
    {
        return $this->belongsTo(ExecutiveCommittee::class);
    }

    // Scope for active members
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for inactive members
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_member')
            ->withPivot('role', 'contribution')
            ->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_member')
            ->withPivot('attended', 'role')
            ->withTimestamps();
    }

    public function getBatchYearAttribute()
    {
        return '20' . substr($this->student_id, 0, 2);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('student_id', 'like', '%' . $search . '%');
            });
        })->when($filters['department'] ?? null, function ($query, $department) {
            $query->where('department', $department);
        })->when($filters['intake'] ?? null, function ($query, $intake) {
            $query->where('intake', $intake);
        })->when(isset($filters['status']), function ($query) use ($filters) {
            if ($filters['status'] === 'active') {
                $query->where('is_active', true);
            } elseif ($filters['status'] === 'inactive') {
                $query->where('is_active', false);
            }
        });
    }

    public function scopeExecutiveMembers($query)
    {
        $query->where('position', '!=', 'General Member');
    }

    public function scopeGeneralMembers($query)
    {
        $query->where('position', 'General Member');
    }

    /**
     * Get the member's position with committee term.
     */
    public function getPositionWithTermAttribute()
    {
        if ($this->executiveCommittee) {
            return "{$this->position} ({$this->executiveCommittee->name})";
        }

        return $this->position;
    }
}