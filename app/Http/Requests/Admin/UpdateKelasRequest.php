<?php

namespace App\Http\Requests\Admin;

class UpdateKelasRequest extends StoreKelasRequest
{
    public function rules(): array
    {
        $id = $this->route('kela')->id ?? $this->route('kelas')->id;
        return [
            'nama_kelas' => "required|string|max:80|unique:kelas,nama_kelas,$id",
            'guru_id' => 'nullable|exists:users,id',
            'kapasitas' => 'required|integer|min:1|max:100',
            'level_jilid' => 'nullable|integer|min:0|max:50',
        ];
    }
}
