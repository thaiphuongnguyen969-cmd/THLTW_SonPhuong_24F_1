<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';

    protected $fillable = [
        'code', 'discount_type', 'discount_value', 'min_order_value', 'usage_limit', 'expires_at'
    ];
}