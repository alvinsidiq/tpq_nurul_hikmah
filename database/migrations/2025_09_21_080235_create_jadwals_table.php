<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $t) {
            $t->id();
            $t->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $t->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $t->foreignId('guru_id')->constrained('users')->cascadeOnDelete();
            $t->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
            $t->time('jam_mulai');
            $t->time('jam_selesai');
            $t->timestamps();
            $t->index(['kelas_id','hari']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
