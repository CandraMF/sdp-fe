<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('pembinaan_kepribadian', function (Blueprint $table) {
				$table->bigIncrements('id',32);
				$table->string('id_jenis_pembinaan_kepribadian',32);
				$table->string('id_upt',32);
				$table->string('id_mitra',32);
				$table->string('nama_program',200);
				$table->boolean('program_wajib');
				$table->string('materi_pembinaan_kepribadian',200);
				$table->string('id_instruktur',32)->nullable();
				$table->string('penangung_jawab',32);
				$table->date('tanggal_mulai');
				$table->date('tanggal_selesai');
				$table->string('tempat_pelaksanaan',200);
				$table->boolean('perlu_kelulusan');
				$table->string('id_sarana',32)->nullable();
				$table->string('id_prasarana',32)->nullable();
				$table->decimal('realisasi_anggaran',18,2)->nullable();
				$table->string('id_jenis_anggaran',32)->nullable();
				$table->string('foto',200);
				$table->string('keterangan',200)->nullable();
				$table->string('status',50);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('pembinaan_kepribadian');
		}
	}