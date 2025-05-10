<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserManagementRequest extends FormRequest
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
            'name' => 'required|string|max:100| min:8',
            'username' => 'required|string|min:8|max:100|unique:users,username',
            'email' => 'required|email|max:100|min:8|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:100',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'role' => 'required|in:admin,operator',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 100 karakter',
            'name.min' => 'Nama minimal 8 karakter',
            'username.required' => 'Username harus diisi',
            'username.string' => 'Username harus berupa string',
            'username.min' => 'Username minimal 8 karakter',
            'username.max' => 'Username maksimal 100 karakter',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan username lain',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 100 karakter',
            'email.min' => 'Email minimal 8 karakter',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 100 karakter',
            'password.regex' => [
                "Password harus mengandung setidaknya satu huruf kecil, satu huruf besar, dan satu angka.",
                "Password harus mengandung setidaknya satu simbol.",
                "Password tidak boleh mengandung spasi.",
                "Password tidak boleh mengandung karakter khusus lainnya.",
                "Password tidak boleh mengandung nama pengguna atau bagian dari nama pengguna.",
                "Password tidak boleh terlalu umum atau mudah ditebak.",
                "Password tidak boleh sama dengan password sebelumnya.",
                "Password tidak boleh terlalu pendek atau terlalu panjang.",
                "Password tidak boleh mengandung informasi pribadi yang mudah ditebak seperti tanggal lahir atau nama keluarga."
            ],
        ];
    }
}
