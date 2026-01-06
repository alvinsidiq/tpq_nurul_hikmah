<?php

namespace App\Http\Requests\Admin;

class UpdateSantriRequest extends StoreSantriRequest
{
    public function rules(): array
    {
        $id = $this->route('santri')?->id ?? null;
        return [
            'no_induk' => "required|string|max:30|unique:santris,no_induk,$id",
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
