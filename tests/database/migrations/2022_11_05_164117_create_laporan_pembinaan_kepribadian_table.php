<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPembinaanKepribadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pembinaan_kepribadian', function (Blueprint $table) {
$table->string('id_upt', 32)->nullable();
$table->enum('bulan', ['januari', 'pebruari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'nopember', 'desember'])->nullable();
$table->integer('tahun')->nullable();
$table->decimal('jumlahhari', 2, 2)->nullable();
$table->decimal('jumlahpembinaankepribadian', 4, 2)->nullable();
$table->decimal('jumlahpeserta', 4, 2)->nullable();
$table->decimal('jumlahinstrukturpetugas', 4, 2)->nullable();
$table->decimal('jumlahinstrukturnapi', 4, 2)->nullable();
$table->decimal('jumlahinstrukturinstansilain', 4, 2)->nullable();
$table->decimal('jumlahinstrukturmitra', 4, 2)->nullable();
$table->string('keterangan', 200)->nullable();
$table->integer('verifikasiupt')->nullable();
$table->integer('verifikasikanwil')->nullable();
$table->integer('verifikasiditjen')->nullable();
$table->dateTime('updateterakhir')->nullable();
$table->string('updateoleh', 32)->nullable();
$table->bigIncrements('id_laporanpembinaankepribadian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_pembinaan_kepribadian');
    }
}
