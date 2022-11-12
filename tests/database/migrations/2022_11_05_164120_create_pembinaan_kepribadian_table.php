<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembinaanKepribadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembinaan_kepribadian', function (Blueprint $table) {
$table->string('id_konfigurasipembinaankepribadian', 32)->nullable();
$table->string('id_mitra', 32)->nullable();
$table->string('id_upt', 32)->nullable();
$table->integer('programwajib')->nullable();
$table->string('materipembinaankepribadian', 200)->nullable();
$table->date('tanggalmulai')->nullable();
$table->date('tanggalselesai')->nullable();
$table->string('tempatpelaksanaan', 200)->nullable();
$table->string('id_sarana', 32)->nullable();
$table->string('id_prasarana', 32)->nullable();
$table->decimal('realisasianggaran', 10, 2)->nullable();
$table->string('id_jenisanggaran', 32)->nullable();
$table->string('foto', 200)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_pembinaankepribadian', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembinaan_kepribadian');
    }
}
