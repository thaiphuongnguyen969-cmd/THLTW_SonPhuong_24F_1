<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Cho phép thêm/sửa các trường này
    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    } // Đóng hàm products() ở đây

    // Trỏ route key sang cột 'name'
    public function getRouteKeyName()
    {
        return 'name';
    }
}