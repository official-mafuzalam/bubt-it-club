<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExecutiveCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'term_start',
        'term_end',
        'description',
    ];

    protected $casts = [
        'term_start' => 'date',
        'term_end' => 'date',
    ];

    /**
     * Get all members that belong to this executive committee.
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get the current active executive committee.
     */
    public function scopeCurrent($query)
    {
        return $query->where('term_start', '<=', now())
            ->where('term_end', '>=', now())
            ->orderBy('term_end', 'desc');
    }

    /**
     * Get past executive committees.
     */
    public function scopePast($query)
    {
        return $query->where('term_end', '<', now())
            ->orderBy('term_end', 'desc');
    }

    /**
     * Get upcoming executive committees.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('term_start', '>', now())
            ->orderBy('term_start', 'asc');
    }

    /**
     * Get the committee term in a readable format.
     */
    public function getTermAttribute()
    {
        return "{$this->term_start->format('M Y')} - {$this->term_end->format('M Y')}";
    }

    /**
     * Check if the committee is currently active.
     */
    public function getIsActiveAttribute()
    {
        return now()->between($this->term_start, $this->term_end);
    }
}