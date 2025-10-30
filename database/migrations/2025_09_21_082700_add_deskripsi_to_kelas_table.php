<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $t) {
            $t->text('deskripsi')->nullable()->after('level_jilid');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $t) {
            $t->dropColumn('deskripsi');
        });
    }
};

