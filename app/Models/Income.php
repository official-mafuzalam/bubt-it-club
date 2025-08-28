<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_id',
        'amount',
        'description',
        'date',
        'inserted_by',
    ];

    /**
     * Get the category that this income belongs to.
     */
    public function category()
    {
        return $this->belongsTo(IncomeCategory::class, 'category_id');
    }

    /**
     * Get the user who inserted this income.
     */
    public function insertedBy()
    {
        return $this->belongsTo(User::class, 'inserted_by');
    }
}
