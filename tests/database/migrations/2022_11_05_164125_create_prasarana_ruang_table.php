<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrasaranaRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prasarana_ruang', function (Blueprint $table) {
$table->string('id_jenis_prasarana_ruang', 32)->nullable();
$table->string('nama_prasarana_ruang', 100)->nullable();
$table->string('id_upt', 32)->nullable();
$table->date('tgl_pengadaan')->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_prasarana_ruang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prasarana_ruang');
    }
}
