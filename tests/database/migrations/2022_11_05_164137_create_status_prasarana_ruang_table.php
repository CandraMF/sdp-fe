<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusPrasaranaRuangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_prasarana_ruang', function (Blueprint $table) {
$table->integer('id_prasarana_ruang')->nullable();
$table->integer('tahun')->nullable();
$table->enum('bulan', ['januari', 'pebruari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'nopember', 'desember'])->nullable();
$table->enum('status', ['tidur', 'dimanfaatkan', 'sengketa', 'disewakan'])->nullable();
$table->enum('kepemilkan', ['upt', 'kanwil', 'ditjen', 'kementerian', 'mitra'])->nullable();
$table->decimal('luas', 6, 2)->nullable();
$table->string('satuan_luas')->nullable();
$table->decimal('jumlah_lantai', 3, 2)->nullable();
$table->decimal('jumlah_ruang', 3, 2)->nullable();
$table->decimal('kondisi_baik', 6, 2)->nullable();
$table->decimal('kondisi_rusak', 6, 2)->nullable();
$table->string('satuan_kondisi')->nullable();
$table->string('foto', 200)->nullable();
$table->enum('pendaftaran_disnaker', ['belum', 'pendaftaran', 'terdaftar'])->nullable();
$table->string('catatan_disnaker', 200)->nullable();
$table->string('keterangan', 200)->nullable();
$table->dateTime('update_terakhir')->nullable();
$table->string('update_oleh', 32)->nullable();
$table->bigIncrements('id_status_prasarana_ruang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_prasarana_ruang');
    }
}
