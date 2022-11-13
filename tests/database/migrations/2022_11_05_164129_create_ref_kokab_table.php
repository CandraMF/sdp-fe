<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefKokabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kokab', function (Blueprint $table) {
$table->string('kokab', 100)->nullable();
$table->string('id_prov', 32)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_kokab', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_kokab');
    }
}
