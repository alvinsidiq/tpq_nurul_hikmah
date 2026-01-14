<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|max:80|unique:kelas,nama_kelas',
            'guru_id' => 'nullable|exists:users,id',
            'kapasitas' => 'required|integer|min:1|max:100',
            'jilid_id' => 'nullable|exists:jilids,id',
        ];
    }
}
