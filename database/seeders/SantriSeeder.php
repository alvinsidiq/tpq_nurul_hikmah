<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        $waliUsers = User::role('wali_santri')->pluck('id')->all();
        $kelas = Kelas::pluck('id')->all();
        if (count($waliUsers) === 0 || count($kelas) === 0) {
            return; // depends on RoleUserSeeder + KelasSeeder
        }

        $data = [
            ['no_induk' => 'S001', 'nama_lengkap' => 'Ahmad Fauzi', 'jilid_id' => 1, 'jilid_level' => 1],
            ['no_induk' => 'S002', 'nama_lengkap' => 'Siti Aminah', 'jilid_id' => 2, 'jilid_level' => 2],
            ['no_induk' => 'S003', 'nama_lengkap' => 'Budi Pratama', 'jilid_id' => 1, 'jilid_level' => 1],
            ['no_induk' => 'S004', 'nama_lengkap' => 'Nur Aisyah', 'jilid_id' => 3, 'jilid_level' => 3],
        ];

        $i = 0;
        foreach ($data as $s) {
            $wal = $waliUsers[$i % count($waliUsers)];
            $kid = $kelas[$i % count($kelas)];
            $i++;
            Santri::firstOrCreate(
                ['no_induk' => $s['no_induk']],
                [
                    'nama_lengkap' => $s['nama_lengkap'],
                    'tgl_lahir' => null,
                    'alamat' => 'Alamat santri tidak diisi',
                    'kelas_id' => $kid,
                    'wali_user_id' => $wal,
                    'jilid_id' => $s['jilid_id'],
                    'jilid_level' => $s['jilid_level'],
                ]
            );
        }
    }
}
