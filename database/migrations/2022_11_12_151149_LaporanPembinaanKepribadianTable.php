<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class LaporanPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('laporan_pembinaan_kepribadian', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_pembinaan_kepribadian');
				$table->string('id_upt',32);
				$table->date('periode');
				$table->decimal('jumlah_hari',2,0);
				$table->decimal('jumlah_pembinaan_kepribadian',4,0);
				$table->decimal('jumlah_peserta',4,0);
				$table->decimal('jumlah_instruktur_petugas',4,0);
				$table->decimal('jumlah_instruktur_napi',4,0);
				$table->decimal('jumlah_instruktur_instansi_lain',4,0);
				$table->decimal('jumlah_instruktur_mitra',4,0);
				$table->string('keterangan',200)->nullable();
				$table->string('status',50);
				$table->string('verifikasi_upt',32);
				$table->string('verifikasi_kanwil',32);
				$table->string('verifikasi_ditjen',32);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('laporan_pembinaan_kepribadian');
		}
	}