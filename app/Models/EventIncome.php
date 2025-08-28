<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'income_category_id',
        'amount',
        'description',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class);
    }
}
