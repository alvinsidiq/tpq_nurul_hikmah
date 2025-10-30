<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKelasSayaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $kelas = $this->route('kela') ?? $this->route('kelas');
        return auth()->check() && auth()->user()->hasRole('guru') && $kelas && (int)$kelas->guru_id === (int)auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'nullable|integer|min:1|max:100',
            'level_jilid' => 'nullable|integer|min:0|max:50',
        ];
    }
}
