<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $t) {
            $t->id();
            $t->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $t->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $t->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $t->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $t->enum('jenis_penilaian', ['UH','UTS','UAS','Praktik']);
            $t->decimal('skor', 5, 2);
            $t->date('tanggal');
            $t->string('catatan')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};

