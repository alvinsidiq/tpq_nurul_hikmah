<?php

namespace Database\Seeders;

use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class KehadiranSeeder extends Seeder
{
    public function run(): void
    {
        $santris = Santri::with('kelas')->get();
        if ($santris->isEmpty()) return;

        $statuses = ['H','I','S','A'];
        foreach ($santris as $idx => $s) {
            // buat 5 record kehadiran terakhir
            for ($d = 1; $d <= 5; $d++) {
                $tanggal = now()->subDays($d)->toDateString();
                $jadwal = Jadwal::where('kelas_id', $s->kelas_id)->first();
                Kehadiran::firstOrCreate(
                    [
                        'santri_id' => $s->id,
                        'tanggal' => $tanggal,
                        'kelas_id' => $s->kelas_id,
                    ],
                    [
                        'jadwal_id' => $jadwal?->id,
                        'status' => $statuses[($idx + $d) % count($statuses)],
                        'keterangan' => null,
                    ]
                );
            }
        }
    }
}

