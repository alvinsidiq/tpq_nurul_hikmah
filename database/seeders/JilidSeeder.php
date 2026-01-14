<?php

namespace Database\Seeders;

use App\Models\Jilid;
use Illuminate\Database\Seeder;

class JilidSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['id' => 1, 'nama' => 'Jilid 1', 'urutan' => 1],
            ['id' => 2, 'nama' => 'Jilid 2', 'urutan' => 2],
            ['id' => 3, 'nama' => 'Jilid 3', 'urutan' => 3],
            ['id' => 4, 'nama' => 'Jilid 4', 'urutan' => 4],
            ['id' => 5, 'nama' => 'Jilid 5', 'urutan' => 5],
            ['id' => 6, 'nama' => 'Jilid 6', 'urutan' => 6],
        ];

        foreach ($items as $item) {
            Jilid::updateOrCreate(['id' => $item['id']], [
                'nama' => $item['nama'],
                'urutan' => $item['urutan'],
            ]);
        }
    }
}
