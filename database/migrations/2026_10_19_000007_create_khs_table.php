<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->string('id_khs')->primary();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->integer('semester');
            $table->string('ips');
            $table->integer('total_sks');

            $table->index(['nim'], 'khs_nim_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('khs');
    }
};
