<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'student_id',
        'department',
        'intake',
        'phone',
        'gender',
        'position',
        'bio',
        'photo_url',
        'social_links',
        'favorite_categories', //like: ['coding', 'design', 'management']
        'is_active',
        'joined_at'
    ];

    protected $casts = [
        'social_links' => 'array',
        'favorite_categories' => 'array',
        'joined_at' => 'date',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

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
        });
    }

    public function scopeExecutiveMembers($query)
    {
        $query->where('position', '!=', 'general_member');
    }

    public function scopeGeneralMembers($query)
    {
        $query->where('position', 'general_member');
    }

    // Add these accessor methods to ensure proper array conversion
    // public function getSocialLinksAttribute($value)
    // {
    //     if (is_array($value)) {
    //         return $value;
    //     }

    //     $decoded = json_decode($value, true);
    //     return is_array($decoded) ? $decoded : [];
    // }

    // public function getFavoriteCategoriesAttribute($value)
    // {
    //     if (is_array($value)) {
    //         return $value;
    //     }

    //     $decoded = json_decode($value, true);
    //     return is_array($decoded) ? $decoded : [];
    // }
}