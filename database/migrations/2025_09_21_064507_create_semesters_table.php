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
        Schema::create('semesters', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $t->string('nama');
            $t->date('tanggal_mulai');
            $t->date('tanggal_selesai');
            $t->boolean('aktif')->default(false);
            $t->timestamps();
            $t->unique(['tahun_ajaran_id','nama']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};

