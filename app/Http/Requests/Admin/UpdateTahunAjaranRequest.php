<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTahunAjaranRequest extends StoreTahunAjaranRequest
{
    public function rules(): array
    {
        $id = $this->route('ta')?->id ?? $this->route('tahun_ajaran')?->id ?? null;
        return [
            'nama' => "required|string|max:60|unique:tahun_ajarans,nama,$id",
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'aktif' => 'boolean',
        ];
    }
}
