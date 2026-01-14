<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $guruIds = User::role('guru')->pluck('id')->all();
        if (count($guruIds) === 0) {
            return; // depends on RoleUserSeeder
        }

        $kelas = [
            ['nama_kelas' => 'Kelas A', 'kapasitas' => 30, 'jilid_id' => 1, 'level_jilid' => 1],
            ['nama_kelas' => 'Kelas B', 'kapasitas' => 28, 'jilid_id' => 2, 'level_jilid' => 2],
            ['nama_kelas' => 'Kelas C', 'kapasitas' => 25, 'jilid_id' => 3, 'level_jilid' => 3],
        ];

        $i = 0;
        foreach ($kelas as $k) {
            $k['guru_id'] = $guruIds[$i % count($guruIds)];
            $i++;
            Kelas::firstOrCreate(
                ['nama_kelas' => $k['nama_kelas']],
                [
                    'guru_id' => $k['guru_id'],
                    'kapasitas' => $k['kapasitas'],
                    'jilid_id' => $k['jilid_id'],
                    'level_jilid' => $k['level_jilid'],
                ]
            );
        }
    }
}
