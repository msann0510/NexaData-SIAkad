<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama_mahasiswa');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');

            $table->index(['id_prodi'], 'mahasiswa_id_prodi_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
