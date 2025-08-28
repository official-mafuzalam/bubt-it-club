<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'expense_category_id',
        'amount',
        'description',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
