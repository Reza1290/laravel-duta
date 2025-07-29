<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'order_date',
        'total_amount',
        'status',
        'notes',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
