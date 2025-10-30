<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure RoleUserSeeder has run so that guru users exist
        $guruUsers = User::role('guru')->get();
        foreach ($guruUsers as $u) {
            Guru::firstOrCreate(
                ['user_id' => $u->id],
                [
                    'nama_lengkap' => $u->name,
                    'nip_nig' => null,
                    'gelar' => null,
                    'no_telepon' => null,
                    'alamat' => 'Alamat guru tidak diisi',
                ]
            );
        }
    }
}

