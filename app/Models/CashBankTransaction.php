<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBankTransaction extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'transaction_code',
        'user_id',
        'transaction_date',
        'type',
        'description',
        'amount',
        'related_account',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
