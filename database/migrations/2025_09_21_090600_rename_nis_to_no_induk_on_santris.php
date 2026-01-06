<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            if (Schema::hasColumn('santris', 'nis')) {
                $table->renameColumn('nis', 'no_induk');
            }
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            if (Schema::hasColumn('santris', 'no_induk')) {
                $table->renameColumn('no_induk', 'nis');
            }
        });
    }
};
