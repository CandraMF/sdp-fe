<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusPrasaranaRuangTable extends Migration
{
	public function up()
	{
		Schema::create('status_prasarana_ruang', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('id_prasarana_ruang');
			$table->date('tanggal');
			$table->enum('status',['TIDUR', 'DIMANFAATKAN', 'SENGKETA', 'DISEWAKAN']);			
			$table->enum('kepemilikan',['UPT', 'KANWIL', 'DITJEN', 'KEMENTERIAN', 'MITRA']);			
			$table->decimal('luas', 6, 0);
			$table->string('satuan_luas', 50);
			$table->decimal('jumlah_lantai', 3,0);
			$table->decimal('jumlah_ruang', 3,0);
			$table->decimal('kondisi_baik', 6,0);
			$table->decimal('kondisi_rusak', 6,0);
			$table->string('satuan_kondisi', 50);
			$table->string('foto', 200);
			$table->enum('pendaftaran_disnaker', ['BELUM', 'PENDAFTARAN', 'TERDAFTAR'])->nullable();
			$table->string('catatan_disnaker', 200)->nullable();
			$table->string('keterangan', 200);
			$table->dateTime('updated_at');
			$table->string('updated_by', 32);
			
		});
	}

	public function down()
	{
		Schema::dropIfExists('status_prasarana_ruang');
	}
}
