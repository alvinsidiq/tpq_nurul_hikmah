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
            'no_induk' => 'required|string|max:30|unique:santris,no_induk',
            'nama_lengkap' => 'required|string|max:120',
            'tgl_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
            'wali_user_id' => 'required|exists:users,id',
            'jilid_id' => 'required|exists:jilids,id',
            'foto' => 'nullable|image|max:2048',
        ];
    }
}
