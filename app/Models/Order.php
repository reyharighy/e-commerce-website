<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'invoice_number',
        'shipping_address',
        'shipping_cost',
        'status',
    ];

    /**
     * Used to get the order completion status.
     */
    static $orderStatus = [
        'pending',
        'paid',
        'processing',
        'shipped',
        'completed',
        'cancelled',
    ];

    /**
     * Get the user that makes the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products that belongs to the order.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    /**
     * Get the details that's included by the order.
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the payment information of the order.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
