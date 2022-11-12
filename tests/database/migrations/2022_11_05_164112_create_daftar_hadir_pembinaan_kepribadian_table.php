<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarHadirPembinaanKepribadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_hadir_pembinaan_kepribadian', function (Blueprint $table) {
$table->string('id_pembinaankepribadian', 32)->nullable();
$table->string('id_wbp', 32)->nullable();
$table->date('tanggalhadir')->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_daftarhadir', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_hadir_pembinaan_kepribadian');
    }
}
