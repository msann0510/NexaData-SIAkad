<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->string('id_krs')->primary();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->string('id_kelas');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->integer('semester');
            $table->date('tanggal_krs');
            $table->string('status_krs');

            $table->index(['nim'], 'krs_nim_index');
            $table->index(['id_kelas'], 'krs_id_kelas_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('krs');
    }
};
