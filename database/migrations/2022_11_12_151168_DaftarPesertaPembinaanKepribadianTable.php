<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class DaftarPesertaPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('daftar_peserta_pembinaan_kepribadian', function (Blueprint $table) {
				
				$table->integer('id_jadwal_pk')->nullable();
				$table->integer('id_peserta')->nullable();
				$table->string('status',50)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->string('verifikasi_oleh',32)->nullable();
				$table->integer('id_daftar_ppk')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('daftar_peserta_pembinaan_kepribadian');
		}
	}