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
            ['nis' => 'S001', 'nama_lengkap' => 'Ahmad Fauzi', 'jilid_level' => 1],
            ['nis' => 'S002', 'nama_lengkap' => 'Siti Aminah', 'jilid_level' => 2],
            ['nis' => 'S003', 'nama_lengkap' => 'Budi Pratama', 'jilid_level' => 1],
            ['nis' => 'S004', 'nama_lengkap' => 'Nur Aisyah', 'jilid_level' => 3],
        ];

        $i = 0;
        foreach ($data as $s) {
            $wal = $waliUsers[$i % count($waliUsers)];
            $kid = $kelas[$i % count($kelas)];
            $i++;
            Santri::firstOrCreate(
                ['nis' => $s['nis']],
                [
                    'nama_lengkap' => $s['nama_lengkap'],
                    'tgl_lahir' => null,
                    'alamat' => 'Alamat santri tidak diisi',
                    'kelas_id' => $kid,
                    'wali_user_id' => $wal,
                    'jilid_level' => $s['jilid_level'],
                ]
            );
        }
    }
}

