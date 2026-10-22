<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->string('id_prodi')->primary();
            $table->string('nama_prodi');
            $table->string('id_fakultas');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas');

            $table->index(['id_fakultas'], 'prodi_id_fakultas_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};
