<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product_id,
            'name' => $this->product_name,
            'slug' => $this->slug,
            'price' => (float) $this->base_price,
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail_url,
        ];
    }
}
