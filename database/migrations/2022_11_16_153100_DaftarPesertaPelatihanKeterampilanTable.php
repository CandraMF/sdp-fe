<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class DaftarPesertaPelatihanKeterampilanTable extends Migration
	{
		public function up()
		{
			Schema::create('daftar_peserta_pelatihan_keterampilan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_jadwal_pk');
				$table->integer('id_peserta');
				$table->enum('status', ['RENCANA', 'SETUJU', 'REVISI']);
				$table->string('keterangan',200)->nullable();
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				$table->string('verifikasi_oleh',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('daftar_peserta_pelatihan_keterampilan');
		}
	}