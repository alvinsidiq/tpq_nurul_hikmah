<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = [
            ['kode' => 'QUR', 'nama' => 'Al-Qur\'an', 'level_id' => 1],
            ['kode' => 'TAJ', 'nama' => 'Tajwid', 'level_id' => 2],
            ['kode' => 'AKH', 'nama' => 'Akhlaq', 'level_id' => 1],
            ['kode' => 'FIQ', 'nama' => 'Fiqih', 'level_id' => 2],
        ];

        foreach ($mapels as $m) {
            MataPelajaran::firstOrCreate(['kode' => $m['kode']], ['nama' => $m['nama'], 'level_id' => $m['level_id']]);
        }
    }
}

