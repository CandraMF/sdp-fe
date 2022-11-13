<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarana', function (Blueprint $table) {
$table->string('id_jenis_sarana', 32)->nullable();
$table->string('nama_sarana', 100)->nullable();
$table->string('id_upt', 32)->nullable();
$table->date('tgl_pengadaan')->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_sarana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sarana');
    }
}
