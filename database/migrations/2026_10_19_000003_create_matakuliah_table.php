<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->string('kode_mk')->primary();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');

            $table->index(['id_prodi'], 'matakuliah_id_prodi_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
};
