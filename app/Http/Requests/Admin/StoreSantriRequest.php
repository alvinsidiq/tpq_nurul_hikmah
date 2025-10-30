<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSantriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|string|max:30|unique:santris,nis',
            'nama_lengkap' => 'required|string|max:120',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
            'wali_user_id' => 'required|exists:users,id',
            'jilid_level' => 'required|integer|min:0|max:50',
            'foto' => 'nullable|image|max:2048',
        ];
    }
}
