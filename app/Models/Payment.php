<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'amount',
        'status',
    ];

    /**
     * Used to define the payment status of the order.
     */
    static $paymentStatus = [
        'pending',
        'success',
        'failed',
    ];

    /**
     * Get the order that belongs the payment.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
