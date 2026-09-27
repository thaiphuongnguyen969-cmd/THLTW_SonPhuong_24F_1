<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'product_id', 'user_id', 'rating', 'comment'
    ];

    // Quan hệ
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}