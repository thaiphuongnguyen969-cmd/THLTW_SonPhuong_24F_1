<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Hoặc các trường khác của bạn

    /**
     * Lấy tên cột dùng để định danh route model binding.
     */
    public function getRouteKeyName()
    {
        return 'name'; // Thay 'id' bằng 'name' hoặc cột slug tùy ý
    }
}