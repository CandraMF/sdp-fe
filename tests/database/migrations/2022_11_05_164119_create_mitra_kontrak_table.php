<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMitraKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_kontrak', function (Blueprint $table) {
$table->string('id_mitra', 32)->nullable();
$table->string('jenis_mitra', 32)->nullable();
$table->string('nomor_kontrak', 200)->nullable();
$table->date('kontrak_awal')->nullable();
$table->date('kontrak_akhir')->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_kontrak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitra_kontrak');
    }
}
