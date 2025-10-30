<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kehadirans', function (Blueprint $t) {
            $t->id();
            $t->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $t->date('tanggal');
            $t->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $t->foreignId('jadwal_id')->nullable()->constrained('jadwals')->nullOnDelete();
            $t->enum('status', ['H','I','S','A']);
            $t->string('keterangan')->nullable();
            $t->timestamps();
            $t->unique(['santri_id','tanggal','kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};

