<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $t) {
            $t->softDeletes();
        });

        Schema::table('mata_pelajarans', function (Blueprint $t) {
            $t->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $t) {
            $t->dropSoftDeletes();
        });

        Schema::table('mata_pelajarans', function (Blueprint $t) {
            $t->dropSoftDeletes();
        });
    }
};
