<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWbpPengawasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wbp_pengawasan', function (Blueprint $table) {
$table->string('id_wbp', 32)->nullable();
$table->string('id_pengawasan', 32)->nullable();
$table->date('tanggalmulai')->nullable();
$table->date('tanggalselesai')->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wbp_pengawasan');
    }
}
