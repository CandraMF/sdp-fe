<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_sarana', function (Blueprint $table) {
$table->integer('id_sarana')->nullable();
$table->integer('tahun')->nullable();
$table->enum('bulan', ['januari', 'pebruari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'nopember', 'desember'])->nullable();
$table->enum('status', ['aktif', 'tidak aktif', 'sebagian'])->nullable();
$table->enum('kepemilkan', ['upt', 'kanwil', 'ditjen', 'kementerian', 'mitra'])->nullable();
$table->integer('jumlah')->nullable();
$table->integer('kondisi_baik')->nullable();
$table->integer('kondisi_rusak')->nullable();
$table->integer('id_status_sarana')->nullable();
$table->string('status_prasarana_lahan')->nullable();
$table->integer('id_prasarana_lahan')->nullable();
$table->decimal('luas_dipakai', 6, 2)->nullable();
$table->decimal('lahan_tidur', 6, 2)->nullable();
$table->string('satuan')->nullable();
$table->string('foto', 200)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_status_prasarana_lahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_sarana');
    }
}
