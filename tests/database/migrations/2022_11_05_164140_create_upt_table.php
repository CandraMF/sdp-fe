<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upt', function (Blueprint $table) {
$table->string('namaupt', 100)->nullable();
$table->string('alamat', 200)->nullable();
$table->string('id_kokab', 32)->nullable();
$table->decimal('notelp', 15, 2)->nullable();
$table->point('koordinat')->nullable();
$table->enum('jenisupt', ['lapas', 'rutan', 'lpka', 'lpp', 'bapas', 'rupbasan'])->nullable();
$table->enum('kelasupt', ['ia', 'ib', 'iia', 'iib', 'iii'])->nullable();
$table->enum('tingkatupt', ['super maxium security', 'maximum security', 'medium security', 'minimal security'])->nullable();
$table->decimal('kapasitas', 7, 2)->nullable();
$table->integer('statusupt')->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_upt', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upt');
    }
}
