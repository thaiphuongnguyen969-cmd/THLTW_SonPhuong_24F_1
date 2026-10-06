<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'address',
        'phone'
    ];

    // Quan hệ N - 1: Đơn hàng thuộc về một khách hàng (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
