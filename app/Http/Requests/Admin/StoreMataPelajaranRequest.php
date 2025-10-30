<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataPelajaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string|max:20|unique:mata_pelajarans,kode',
            'nama' => 'required|string|max:120',
            'level_id' => 'nullable|integer|min:0',
        ];
    }
}
