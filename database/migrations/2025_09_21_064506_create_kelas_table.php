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
        Schema::create('kelas', function (Blueprint $t) {
            $t->id();
            $t->string('nama_kelas')->unique();
            $t->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
            $t->unsignedInteger('kapasitas')->default(30);
            $t->unsignedInteger('level_jilid')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
