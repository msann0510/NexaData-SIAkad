<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('id_dosen')->primary();
            $table->string('nama_dosen');
            $table->string('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');

            $table->index(['id_prodi'], 'id_prodi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen');
    }
};
