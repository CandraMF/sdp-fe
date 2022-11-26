<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('pembinaan_kepribadian', function (Blueprint $table) {
				
				$table->string('id_jenis_pembinaan_kepribadian',32)->nullable();
				$table->string('id_upt',32)->nullable();
				$table->string('id_mitra',32)->nullable();
				$table->string('nama_program',200)->nullable();
				$table->boolean('program_wajib')->nullable();
				$table->string('materi_pembinaan_kepribadian',200)->nullable();
				$table->string('id_instruktur',32)->nullable();
				$table->string('penangung_jawab',32)->nullable();
				$table->date('tanggal_mulai')->nullable();
				$table->date('tanggal_selesai')->nullable();
				$table->string('tempat_pelaksanaan',200)->nullable();
				$table->boolean('perlu_kelulusan')->nullable();
				$table->string('id_sarana',32)->nullable();
				$table->string('id_prasarana',32)->nullable();
				$table->decimal('realisasi_anggaran',18,2)->nullable();
				$table->string('id_jenis_anggaran',32)->nullable();
				$table->string('foto',200)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->string('status',50)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_pembinaan_kepribadian',32)->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('pembinaan_kepribadian');
		}
	}