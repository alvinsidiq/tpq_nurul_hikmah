<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'Lomba Tahfidz Bulanan', 'tanggal' => now()->toDateString(), 'lokasi' => 'Aula TPQ', 'deskripsi' => 'Kegiatan rutin bulanan untuk menghafal juz pilihan.'],
            ['nama' => 'Bakti Sosial', 'tanggal' => now()->addDays(10)->toDateString(), 'lokasi' => 'Lingkungan TPQ', 'deskripsi' => 'Membersihkan lingkungan sekitar TPQ bersama-sama.'],
        ];

        foreach ($items as $i) {
            Kegiatan::firstOrCreate(
                ['nama' => $i['nama']],
                ['tanggal' => $i['tanggal'], 'lokasi' => $i['lokasi'], 'deskripsi' => $i['deskripsi']]
            );
        }
    }
}
