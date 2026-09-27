<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id', 'shipping_address', 'total_amount', 'shipping_fee', 'order_status', 'payment_method', 'payment_status'
    ];

    // Quan hệ
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function items() {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}