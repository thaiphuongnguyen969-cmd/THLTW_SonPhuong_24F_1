<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $primaryKey = 'brand_id';

    protected $fillable = ['name', 'slug', 'image', 'sort_order', 'status'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 1);
    }
}
