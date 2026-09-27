<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'user_id', 'receiver_name', 'phone_number', 'province', 'district', 'ward', 'specific_address', 'is_default'
    ];

    // Quan hệ
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}