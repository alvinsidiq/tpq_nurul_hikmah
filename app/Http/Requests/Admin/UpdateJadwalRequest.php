<?php

namespace App\Http\Requests\Admin;

use App\Models\Jadwal;

class UpdateJadwalRequest extends StoreJadwalRequest
{
    public function messages(): array
    {
        // gunakan pesan yang sama dengan StoreJadwalRequest
        return parent::messages();
    }

    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            $kelas = $this->input('kelas_id');
            $mapel = $this->input('mata_pelajaran_id');
            $guru = $this->input('guru_id');
            $hari = $this->input('hari');
            $mulai = $this->input('jam_mulai');
            $selesai = $this->input('jam_selesai');
            $currentId = $this->route('jadwal')?->id;

            if (!$kelas || !$hari || !$mulai || !$selesai) {
                return;
            }

            $conflict = Jadwal::where('kelas_id', $kelas)
                ->where('hari', $hari)
                ->when($currentId, fn($q) => $q->where('id', '!=', $currentId))
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

            if ($kelas && $mapel && $guru) {
                $existing = Jadwal::where('kelas_id', $kelas)
                    ->where('mata_pelajaran_id', $mapel)
                    ->when($currentId, fn ($q) => $q->where('id', '!=', $currentId))
                    ->first();

                if ($existing && (int) $existing->guru_id !== (int) $guru) {
                    $v->errors()->add('guru_id', 'Mapel ini sudah diampu guru lain di kelas tersebut.');
                }
            }
        });
    }
}
