<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PesertaPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('peserta_pembinaan_kepribadian', function (Blueprint $table) {
				
				$table->integer('id_daftar_pembinaan_kepribadian')->nullable();
				$table->integer('id_wbp')->nullable();
				$table->boolean('kehadiran')->nullable();
				$table->string('no_sertifikat',50)->nullable();
				$table->string('file_sertifikat',200)->nullable();
				$table->decimal('nilai',3,0)->nullable();
				$table->string('predikat',50)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_peserta_pk')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('peserta_pembinaan_kepribadian');
		}
	}