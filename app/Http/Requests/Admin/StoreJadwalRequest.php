<?php

namespace App\Http\Requests\Admin;

use App\Models\Jadwal;
use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'required|exists:users,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ];
    }

    public function attributes(): array
    {
        return [
            'kelas_id' => 'kelas',
            'mata_pelajaran_id' => 'mata pelajaran',
            'guru_id' => 'guru',
            'hari' => 'hari',
            'jam_mulai' => 'jam mulai',
            'jam_selesai' => 'jam selesai',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':Attribute wajib diisi.',
            'exists' => ':Attribute tidak valid.',
            'in' => ':Attribute tidak valid.',
            'date_format' => ':Attribute tidak sesuai format HH:MM.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            $kelas = $this->input('kelas_id');
            $hari = $this->input('hari');
            $mulai = $this->input('jam_mulai');
            $selesai = $this->input('jam_selesai');

            if (!$kelas || !$hari || !$mulai || !$selesai) {
                return;
            }

            $conflict = Jadwal::where('kelas_id', $kelas)
                ->where('hari', $hari)
                ->where(function ($q) use ($mulai, $selesai) {
                    $q->whereBetween('jam_mulai', [$mulai, $selesai])
                      ->orWhereBetween('jam_selesai', [$mulai, $selesai])
                      ->orWhere(function ($qq) use ($mulai, $selesai) {
                          $qq->where('jam_mulai', '<=', $mulai)
                             ->where('jam_selesai', '>=', $selesai);
                      });
                })->exists();

            if ($conflict) {
                $v->errors()->add('jam_mulai', 'Jadwal bentrok.');
            }
        });
    }
}
