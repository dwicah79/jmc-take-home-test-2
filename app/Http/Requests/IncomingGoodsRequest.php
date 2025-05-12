<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class IncomingGoodsRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'origin_of_goods' => 'required|string',
            'attachment' => 'nullable|file|mimes:doc,docx,zip',
            'unit' => 'nullable|string|max:100',
            'number_document' => 'nullable|string|max:100',

            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.volume' => 'required|numeric',
            'items.*.unit' => 'required|string',
            'items.*.expired_date' => 'nullable|date',
            'items.*.total_price' => 'required|min:0',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Operator wajib diisi',
            'category_id.required' => 'Category wajib diisi',
            'subcategory_id.required' => 'Subcategory wajib diisi',
            'origin.required' => 'Asal barang wajib diisi',
            'unit.max' => 'Unit maksimal 100 karakter',
            'number_document.max' => 'Nomor dokumen maksimal 100 karakter',
            'attachment.file' => 'File harus berupa dokumen doc,docx,zip',
            'origin.max' => 'Asal barang maksimal 200 karakter',
            'items.*.name.required' => 'Nama barang wajib diisi',
            'price.required' => 'harga barang wajib diisi',
            'volume.required' => 'qty wajib diisi',
            'unit.required' => ' unit wajib diisi',
            'attachment.mimes' => 'File harus berupa dokumen doc,docx,zip',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::error('Validasi gagal:', $validator->errors()->toArray());

        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
        );
    }
}
