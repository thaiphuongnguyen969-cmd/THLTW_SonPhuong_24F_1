<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:brands,name',
            'description' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên thương hiệu không được để trống.',
            'name.max' => 'Tên thương hiệu không quá 100 ký tự.',
            'name.unique' => 'Thương hiệu này đã tồn tại.',
        ];
    }
}