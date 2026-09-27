<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id', 'product_name', 'slug', 'description', 'base_price', 'thumbnail_url'
    ];

    // Quan hệ
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }
}