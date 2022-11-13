<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPembinaanKepribadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pembinaan_kepribadian', function (Blueprint $table) {
$table->string('jenispembinaankepribadian', 100)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_jenispembinaankepribadian', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_pembinaan_kepribadian');
    }
}
