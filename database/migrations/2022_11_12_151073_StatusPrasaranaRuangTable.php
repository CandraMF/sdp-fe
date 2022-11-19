<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class StatusPrasaranaRuangTable extends Migration
	{
		public function up()
		{
			Schema::create('status_prasarana_ruang', function (Blueprint $table) {
				
				$table->integer('id_prasarana_ruang')->nullable();
				$table->integer('tahun')->nullable();
				$table->string('bulan',50)->nullable();
				$table->string('status',50)->nullable();
				$table->string('kepemilkan',50)->nullable();
				$table->decimal('luas',6,2)->nullable();
				$table->string('satuan_luas',50)->nullable();
				$table->decimal('jumlah_lantai',3)->nullable();
				$table->decimal('jumlah_ruang',3)->nullable();
				$table->decimal('kondisi_baik',6)->nullable();
				$table->decimal('kondisi_rusak',6)->nullable();
				$table->string('satuan_kondisi',50)->nullable();
				$table->string('foto',200)->nullable();
				$table->string('pendaftaran_disnaker',50)->nullable();
				$table->string('catatan_disnaker',200)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_status_prasarana_ruang')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('status_prasarana_ruang');
		}
	}