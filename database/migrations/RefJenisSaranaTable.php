<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefJenisSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_jenis_sarana', function (Blueprint $table) {
            $table->bigIncrements('id_jenissarana');
            $table->string('jenissarana',100)->nullable();
            $table->string('keterangan',200)->nullable();
            $table->timestamps("updateterakhir")->nullable();
            $table->string('updateoleh',256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_jenis_sarana');
    }
}
