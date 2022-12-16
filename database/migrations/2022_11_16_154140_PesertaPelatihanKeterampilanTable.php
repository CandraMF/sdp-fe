<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PesertaPelatihanKeterampilanTable extends Migration
	{
		public function up()
		{
			Schema::create('peserta_pelatihan_keterampilan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_daftar_peserta_pelatihan_keterampilan');
				$table->integer('id_wbp');
				$table->boolean('kehadiran');
				$table->string('no_sertifikat',50);
				$table->string('file_sertifikat',200);
				$table->decimal('nilai',3,0);
				$table->string('predikat',50);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('peserta_pelatihan_keterampilan');
		}
	}