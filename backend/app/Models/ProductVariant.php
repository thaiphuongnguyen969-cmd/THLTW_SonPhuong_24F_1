<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'variant_id';

    protected $fillable = [
        'product_id', 'size', 'color', 'price', 'stock_quantity', 'sku'
    ];

    // Quan hệ
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }
}