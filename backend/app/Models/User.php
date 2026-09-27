<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id'; // Khóa chính tùy chỉnh

    protected $fillable = [
        'username', 'email', 'password_hash', 'full_name', 'phone_number', 'role'
    ];

    // Các quan hệ
    public function addresses() {
        return $this->hasMany(Address::class, 'user_id', 'user_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id', 'user_id');
    }
}