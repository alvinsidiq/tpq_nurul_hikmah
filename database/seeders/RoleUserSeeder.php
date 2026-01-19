<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['admin','guru','wali_santri'] as $r) {
            Role::findOrCreate($r);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@tpq.test'],
            ['name' => 'Admin TPQ', 'password' => Hash::make('password'), 'status' => 'active']
        );
        $admin->assignRole('admin');

        $guruUsers = [
            [
                'email' => 'guru1@tpq.test',
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567890',
                'alamat' => 'Jl. Melati No. 12, Cibinong',
            ],
            [
                'email' => 'guru2@tpq.test',
                'name' => 'Siti Nur Aisyah',
                'phone' => '081326789012',
                'alamat' => 'Jl. Kenanga No. 8, Bogor',
            ],
            [
                'email' => 'guru3@tpq.test',
                'name' => 'Muhammad Rizky Pratama',
                'phone' => '081290112233',
                'alamat' => 'Jl. Anggrek No. 4, Depok',
            ],
            [
                'email' => 'guru4@tpq.test',
                'name' => 'Dewi Lestari',
                'phone' => '081298765432',
                'alamat' => 'Jl. Mawar No. 15, Depok',
            ],
        ];

        foreach ($guruUsers as $data) {
            $guru = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'phone' => $data['phone'],
                    'status' => 'active',
                    'alamat' => $data['alamat'],
                ]
            );
            $guru->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'status' => 'active',
                'alamat' => $data['alamat'],
            ]);
            $guru->assignRole('guru');
        }

        $wali1 = User::firstOrCreate(
            ['email' => 'wali1@tpq.test'],
            ['name' => 'Wali Satu', 'password' => Hash::make('password')]
        );
        $wali1->assignRole('wali_santri');

        $wali2 = User::firstOrCreate(
            ['email' => 'wali2@tpq.test'],
            ['name' => 'Wali Dua', 'password' => Hash::make('password')]
        );
        $wali2->assignRole('wali_santri');
    }
}
