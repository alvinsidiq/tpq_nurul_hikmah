<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:180',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:180',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'notify' => 'nullable|boolean',
        ];
    }
}
