<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get all incomes under this category.
     */
    public function incomes()
    {
        return $this->hasMany(Income::class, 'category_id');
    }
}
