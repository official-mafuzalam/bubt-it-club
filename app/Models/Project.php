<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image_url',
        'github_url',
        'demo_url',
        'technologies', // Added technologies here
        'is_published',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_published' => 'boolean',
        'technologies' => 'array' // Cast to array
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'project_member')
            ->withPivot('role', 'contribution')
            ->withTimestamps();
    }

    public function getDurationAttribute()
    {
        if ($this->end_date) {
            return $this->start_date->diffInMonths($this->end_date) . ' months';
        }
        return 'Ongoing since ' . $this->start_date->format('M Y');
    }
}