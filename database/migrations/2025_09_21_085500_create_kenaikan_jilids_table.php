<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kenaikan_jilids', function (Blueprint $t) {
            $t->id();
            $t->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $t->unsignedInteger('dari_jilid');
            $t->unsignedInteger('ke_jilid');
            $t->date('tanggal');
            $t->foreignId('disetujui_oleh')->constrained('users');
            $t->string('catatan')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kenaikan_jilids');
    }
};

