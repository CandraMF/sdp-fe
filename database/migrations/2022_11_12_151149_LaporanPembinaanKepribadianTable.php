<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class LaporanPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('laporan_pembinaan_kepribadian', function (Blueprint $table) {
				
				$table->integer('id_pembinaan_kepribadian')->nullable();
				$table->string('id_upt',32)->nullable();
				$table->string('bulan',50)->nullable();
				$table->integer('tahun')->nullable();
				$table->decimal('jumlah_hari',2)->nullable();
				$table->decimal('jumlah_pembinaan_kepribadian',4)->nullable();
				$table->decimal('jumlah_peserta',4)->nullable();
				$table->decimal('jumlah_instruktur_petugas',4)->nullable();
				$table->decimal('jumlah_instruktur_napi',4)->nullable();
				$table->decimal('jumlah_instruktur_instansi_lain',4)->nullable();
				$table->decimal('jumlah_instruktur_mitra',4)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->string('status',50)->nullable();
				$table->string('verifikasi_upt',32)->nullable();
				$table->string('verifikasi_kanwil',32)->nullable();
				$table->string('verifikasi_ditjen',32)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->integer('id_laporan_pk')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('laporan_pembinaan_kepribadian');
		}
	}