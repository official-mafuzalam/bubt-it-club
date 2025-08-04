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
        'student_id',
        'department',
        'batch',
        'phone',
        'gender',
        'position',
        'bio',
        'photo_url',
        'social_links',
        'is_active',
        'joined_at'
    ];

    protected $casts = [
        'social_links' => 'array',
        'joined_at' => 'date',
        'is_active' => 'boolean'
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
}