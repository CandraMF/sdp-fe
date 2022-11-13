<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarReferensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_referensi', function (Blueprint $table) {
$table->string('groups', 100)->nullable();
$table->string('deskripsi', 100)->nullable();
$table->string('catatan', 100)->nullable();
$table->bigIncrements('id_lookup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_referensi');
    }
}
