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
        Schema::create('santris', function (Blueprint $t) {
            $t->id();
            $t->string('no_induk')->unique();
            $t->string('nama_lengkap');
            $t->date('tgl_lahir')->nullable();
            $t->text('alamat')->nullable();
            $t->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $t->foreignId('wali_user_id')->constrained('users')->cascadeOnDelete();
            $t->unsignedInteger('jilid_level')->default(0);
            $t->string('foto_path')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
