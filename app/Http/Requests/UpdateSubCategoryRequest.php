<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sub_category_name' => 'required|string|max:255',
            'price_range' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'sub_category_name.required' => 'Nama sub kategori harus diisi',
            'price_range.required' => 'Rentang harga harus diisi',
            'price_range.numeric' => 'Rentang harga harus berupa angka',
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists' => 'Kategori yang dipilih tidak valid',
        ];
    }
}
