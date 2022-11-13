<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
$table->string('nama_mitra', 100)->nullable();
$table->string('nama_pic', 100)->nullable();
$table->string('alamat', 200)->nullable();
$table->string('id_dati2', 32)->nullable();
$table->string('no_telp', 20)->nullable();
$table->string('no_hp', 20)->nullable();
$table->string('email', 50)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_mitra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitra');
    }
}
