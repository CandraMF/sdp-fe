<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWbpUptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wbp_upt', function (Blueprint $table) {
$table->string('id_wbp', 32)->nullable();
$table->string('id_upt', 32)->nullable();
$table->string('id_register', 32)->nullable();
$table->dateTime('tanggalmasuk')->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_wbp_upt', 32)->nullable();
$table->string('konfigurasi_pembinaan_kepribadian')->nullable();
$table->string('konfigurasipembinaankepribadian', 100)->nullable();
$table->string('keterangan', 200)->nullable();
$table->string('id_jenispembinaankepribadian', 32)->nullable();
$table->string('id_konfigurasipembinaankepribadian', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wbp_upt');
    }
}
