<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:120',
            'email' => 'required|email',
            'no_telepon' => 'nullable',
            'alamat' => 'nullable|string',
        ];
    }
}
