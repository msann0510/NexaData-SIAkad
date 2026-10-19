<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('id_kelas')->primary();
            $table->string('nama_kelas');
            $table->string('kode_mk');
            $table->foreign('kode_mk')->references('kode_mk')->on('matakuliah');
            $table->string('id_dosen');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');

            $table->index(['kode_mk'], 'kode_mk');
            $table->index(['id_dosen'], 'id_dosen');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};
