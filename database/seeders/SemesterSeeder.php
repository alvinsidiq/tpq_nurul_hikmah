<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $tas = TahunAjaran::all();
        foreach ($tas as $ta) {
            $data = [
                [
                    'tahun_ajaran_id' => $ta->id,
                    'nama' => 'Ganjil',
                    'tanggal_mulai' => date('Y-m-d', strtotime($ta->tanggal_mulai)),
                    'tanggal_selesai' => date('Y-m-d', strtotime($ta->tanggal_mulai.' +5 months')),
                    'aktif' => $ta->aktif,
                ],
                [
                    'tahun_ajaran_id' => $ta->id,
                    'nama' => 'Genap',
                    'tanggal_mulai' => date('Y-m-d', strtotime($ta->tanggal_mulai.' +6 months')),
                    'tanggal_selesai' => date('Y-m-d', strtotime($ta->tanggal_selesai)),
                    'aktif' => false,
                ],
            ];

            foreach ($data as $s) {
                Semester::firstOrCreate(
                    ['tahun_ajaran_id' => $s['tahun_ajaran_id'], 'nama' => $s['nama']],
                    [
                        'tanggal_mulai' => $s['tanggal_mulai'],
                        'tanggal_selesai' => $s['tanggal_selesai'],
                        'aktif' => $s['aktif'],
                    ]
                );
            }
        }
    }
}

