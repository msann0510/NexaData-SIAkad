<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->string('id_presensi')->primary();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->string('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->date('tanggal');
            $table->integer('pertemuan_ke');
            $table->string('status_hadir');

            $table->index(['nim'], 'presensi_nim_index');
            $table->index(['id_kelas'], 'presensi_id_kelas_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensi');
    }
};
