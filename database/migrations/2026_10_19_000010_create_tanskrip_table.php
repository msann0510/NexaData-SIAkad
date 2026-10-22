<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanskrip', function (Blueprint $table) {
            $table->string('id_transkrip')->primary();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa');
            $table->string('ipk');
            $table->integer('total_sks_lulus');
            $table->date('tanggal_cetak');

            $table->index(['nim'], 'tanskrip_nim_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanskrip');
    }
};
