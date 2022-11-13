<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWbpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wbp', function (Blueprint $table) {
$table->string('nama', 100)->nullable();
$table->string('id_register', 32)->nullable();
$table->enum('jeniskelamin', ['laki-laki', 'perempuan'])->nullable();
$table->string('id_suku', 32)->nullable();
$table->string('tempatlahir', 100)->nullable();
$table->date('tanggallahir')->nullable();
$table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu'])->nullable();
$table->enum('pendidikan', ['sd', 'smp', 'sma', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3'])->nullable();
$table->string('pekerjaan', 100)->nullable();
$table->string('id_tidakpidana', 32)->nullable();
$table->string('alamat', 200)->nullable();
$table->string('id_kokab', 32)->nullable();
$table->string('id_jenistahanan', 32)->nullable();
$table->string('keputusan', 100)->nullable();
$table->string('lamapidana', 100)->nullable();
$table->string('sisapidana', 100)->nullable();
$table->decimal('residivisme', 4, 2)->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->string('id_wbp', 32)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wbp');
    }
}
