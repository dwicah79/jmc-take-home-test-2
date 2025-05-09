<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_category' => 'required|string|max:255',
            'code_category' => 'required|string|max:255|unique:categories,code_category',
        ];
    }

    public function messages(): array
    {
        return [
            'name_category.required' => 'Nama kategori harus diisi',
            'name_category.max' => 'Nama kategori maksimal 255 karakter',
            'code_category.required' => 'Kode kategori harus diisi',
            'code_category.max' => 'Kode kategori maksimal 255 karakter',
            'code_category.unique' => 'Kode kategori sudah terdaftar, silakan gunakan kode lain',
        ];
    }
}
