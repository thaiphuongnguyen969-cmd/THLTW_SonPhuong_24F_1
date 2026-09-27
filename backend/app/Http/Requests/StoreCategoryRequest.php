<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return true;
}

public function toArray($request): array
{
    return [
        'category_id' => $this->category_id,
        'category_name' => $this->category_name,
        'slug' => $this->slug,
        'parent_id' => $this->parent_id,
        // Có thể lồng thêm quan hệ nếu cần (ví dụ danh mục con hoặc sản phẩm)
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
