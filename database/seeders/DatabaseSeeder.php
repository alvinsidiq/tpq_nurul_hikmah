<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base roles and sample users (admin, guru, wali)
        $this->call(RoleUserSeeder::class);

        // Akademik data
        $this->call(TahunAjaranSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(MataPelajaranSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(SantriSeeder::class);
        $this->call(JadwalSeeder::class);

        // Kegiatan
        $this->call(KegiatanSeeder::class);

        // Data untuk laporan
        $this->call(KehadiranSeeder::class);
        $this->call(NilaiSeeder::class);
    }
}
