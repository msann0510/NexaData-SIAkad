<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('id_dosen')->primary();
            $table->string('nama_dosen');
            $table->string('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');

            $table->index(['id_prodi'], 'dosen_id_prodi_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
};
