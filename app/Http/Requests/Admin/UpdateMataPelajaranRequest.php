<?php

namespace App\Http\Requests\Admin;

class UpdateMataPelajaranRequest extends StoreMataPelajaranRequest
{
    public function rules(): array
    {
        $id = $this->route('mapel')?->id ?? $this->route('mata_pelajaran')?->id ?? null;
        return [
            'kode' => "required|string|max:20|unique:mata_pelajarans,kode,$id",
            'nama' => 'required|string|max:120',
            'level_id' => 'nullable|integer|min:0',
        ];
    }
}
