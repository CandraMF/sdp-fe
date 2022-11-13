<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_anggaran', function (Blueprint $table) {
$table->string('jenisanggaran', 100)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_jenisanggaran', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_anggaran');
    }
}
