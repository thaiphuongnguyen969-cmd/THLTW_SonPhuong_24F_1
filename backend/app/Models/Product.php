<?php

namespace App\Models;
use App\Models\Brand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'description',
        'price',
        'image',
        'quantity',
    ];

    // Thiết lập quan hệ: Một sản phẩm thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Trỏ route key sang cột 'name' để có thể tìm kiếm sản phẩm bằng tên trên URL
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function brand()
{
    return $this->belongsTo(Brand::class);
}
}