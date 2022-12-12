<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class JadwalPelatihanKeterampilanTable extends Migration
	{
		public function up()
		{
			Schema::create('jadwal_pelatihan_keterampilan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_pelatihan_keterampilan');
				$table->date('tanggal');
				$table->time('jam_mulai');
				$table->time('jam_selesai');
				$table->string('id_instruktur',32)->nullable();
				$table->string('materi_pelatihan_keterampilan',200);
				$table->string('foto',200)->nullable();
				$table->enum('status', ['RENCANA', 'PELAKSANAAN', 'TERLAKSANA', 'SELESAI']);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('jadwal_pelatihan_keterampilan');
		}
	}