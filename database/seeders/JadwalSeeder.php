<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = Kelas::all();
        $mapels = MataPelajaran::pluck('id')->all();
        $guruIds = User::role('guru')->pluck('id')->all();

        if ($kelas->isEmpty() || empty($mapels) || empty($guruIds)) {
            return; // depends on previous seeders
        }

        $hariList = ['Senin','Rabu','Jumat'];
        foreach ($kelas as $index => $k) {
            // two jadwals per kelas
            for ($j = 0; $j < 2; $j++) {
                $hari = $hariList[($index + $j) % count($hariList)];
                $jamMulai = sprintf('%02d:00', 14 + $j); // 14:00 / 15:00
                $jamSelesai = sprintf('%02d:50', 14 + $j);
                Jadwal::firstOrCreate(
                    [
                        'kelas_id' => $k->id,
                        'mata_pelajaran_id' => $mapels[($index + $j) % count($mapels)],
                        'guru_id' => $guruIds[($index + $j) % count($guruIds)],
                        'hari' => $hari,
                        'jam_mulai' => $jamMulai,
                    ],
                    [
                        'jam_selesai' => $jamSelesai,
                    ]
                );
            }
        }
    }
}

