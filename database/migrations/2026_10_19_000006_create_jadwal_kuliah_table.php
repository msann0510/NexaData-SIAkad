<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->string('id_jadwal')->primary();
            $table->string('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan');

            $table->index(['id_kelas'], 'id_kelas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
