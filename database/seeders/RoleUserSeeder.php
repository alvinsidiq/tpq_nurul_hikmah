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

        $guru1 = User::firstOrCreate(
            ['email' => 'guru1@tpq.test'],
            ['name' => 'Guru Satu', 'password' => Hash::make('password')]
        );
        $guru1->assignRole('guru');

        $guru2 = User::firstOrCreate(
            ['email' => 'guru2@tpq.test'],
            ['name' => 'Guru Dua', 'password' => Hash::make('password')]
        );
        $guru2->assignRole('guru');

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
