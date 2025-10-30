<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $tas = [
            ['nama' => '2023/2024', 'tanggal_mulai' => '2023-07-10', 'tanggal_selesai' => '2024-06-30', 'aktif' => false],
            ['nama' => '2024/2025', 'tanggal_mulai' => '2024-07-10', 'tanggal_selesai' => '2025-06-30', 'aktif' => true],
        ];

        foreach ($tas as $ta) {
            $created = TahunAjaran::firstOrCreate(
                ['nama' => $ta['nama']],
                ['tanggal_mulai' => $ta['tanggal_mulai'], 'tanggal_selesai' => $ta['tanggal_selesai'], 'aktif' => $ta['aktif']]
            );
            if ($created->aktif) {
                TahunAjaran::where('id', '!=', $created->id)->update(['aktif' => false]);
            }
        }
    }
}

