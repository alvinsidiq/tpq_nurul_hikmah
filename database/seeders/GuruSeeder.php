<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            'guru1@tpq.test' => [
                'nama_lengkap' => 'Ahmad Fauzi',
                'nip_nig' => '198702152017011001',
                'gelar' => 'S.Pd.I',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Melati No. 12, Cibinong',
            ],
            'guru2@tpq.test' => [
                'nama_lengkap' => 'Siti Nur Aisyah',
                'nip_nig' => '199104102018022002',
                'gelar' => 'S.Pd',
                'no_telepon' => '081326789012',
                'alamat' => 'Jl. Kenanga No. 8, Bogor',
            ],
            'guru3@tpq.test' => [
                'nama_lengkap' => 'Muhammad Rizky Pratama',
                'nip_nig' => '199307252019031003',
                'gelar' => 'S.Ag',
                'no_telepon' => '081290112233',
                'alamat' => 'Jl. Anggrek No. 4, Depok',
            ],
            'guru4@tpq.test' => [
                'nama_lengkap' => 'Dewi Lestari',
                'nip_nig' => '199006182017122004',
                'gelar' => 'M.Pd',
                'no_telepon' => '081298765432',
                'alamat' => 'Jl. Mawar No. 15, Depok',
            ],
        ];

        // Ensure RoleUserSeeder has run so that guru users exist
        $guruUsers = User::role('guru')->get();
        foreach ($guruUsers as $u) {
            $profile = $profiles[$u->email] ?? [
                'nama_lengkap' => $u->name,
                'nip_nig' => null,
                'gelar' => null,
                'no_telepon' => $u->phone,
                'alamat' => $u->alamat ?: 'Alamat guru tidak diisi',
            ];

            Guru::updateOrCreate(
                ['user_id' => $u->id],
                $profile
            );
        }
    }
}
