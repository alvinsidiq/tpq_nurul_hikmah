<?php

namespace Database\Seeders;

use App\Models\Nilai;
use App\Models\Santri;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $santris = Santri::all();
        $mapels = MataPelajaran::pluck('id')->all();
        $semester = Semester::first();
        $ta = TahunAjaran::where('aktif', true)->first() ?? TahunAjaran::first();

        if ($santris->isEmpty() || empty($mapels) || !$semester || !$ta) return;

        $jenis = array_keys(config('penilaian.jenis', ['UH','UTS','UAS']));
        foreach ($santris as $i => $s) {
            foreach ($mapels as $j => $mapelId) {
                $jenisIdx = ($i + $j) % count($jenis);
                $tanggal = now()->subDays(($i + $j) % 10)->toDateString();
                Nilai::firstOrCreate(
                    [
                        'santri_id' => $s->id,
                        'mata_pelajaran_id' => $mapelId,
                        'semester_id' => $semester->id,
                        'tahun_ajaran_id' => $ta->id,
                        'jenis_penilaian' => $jenis[$jenisIdx],
                        'tanggal' => $tanggal,
                    ],
                    [
                        'skor' => 60 + (($i + $j) % 40),
                        'catatan' => 'Baik',
                    ]
                );
            }
        }
    }
}
