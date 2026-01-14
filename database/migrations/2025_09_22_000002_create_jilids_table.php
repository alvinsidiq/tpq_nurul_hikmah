<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jilids', function (Blueprint $t) {
            $t->increments('id');
            $t->string('nama');
            $t->unsignedInteger('urutan')->default(0);
            $t->timestamps();
        });

        Schema::table('kelas', function (Blueprint $t) {
            $t->unsignedInteger('jilid_id')->nullable()->after('level_jilid');
            $t->foreign('jilid_id')->references('id')->on('jilids')->nullOnDelete();
        });

        Schema::table('santris', function (Blueprint $t) {
            $t->unsignedInteger('jilid_id')->nullable()->after('jilid_level');
            $t->foreign('jilid_id')->references('id')->on('jilids')->nullOnDelete();
        });

        Schema::table('mata_pelajarans', function (Blueprint $t) {
            $t->foreign('level_id')->references('id')->on('jilids')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mata_pelajarans', function (Blueprint $t) {
            $t->dropForeign(['level_id']);
        });

        Schema::table('santris', function (Blueprint $t) {
            $t->dropForeign(['jilid_id']);
            $t->dropColumn('jilid_id');
        });

        Schema::table('kelas', function (Blueprint $t) {
            $t->dropForeign(['jilid_id']);
            $t->dropColumn('jilid_id');
        });

        Schema::dropIfExists('jilids');
    }
};
