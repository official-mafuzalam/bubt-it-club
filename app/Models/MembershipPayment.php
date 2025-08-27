<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
    ];

    /**
     * Each payment belongs to a member.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
