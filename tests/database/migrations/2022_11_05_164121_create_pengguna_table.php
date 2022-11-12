<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
$table->string('nama', 100)->nullable();
$table->string('password', 32)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_user', 32)->nullable();
$table->string('peserta')->nullable();
$table->string('id_wbp', 32)->nullable();
$table->string('id_pembinaankepribadian', 32)->nullable();
$table->string('nomorsertifikat', 100)->nullable();
$table->date('tanggalsertifikat')->nullable();
$table->string('keterangan', 200)->nullable();
$table->string('id_peserta', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
