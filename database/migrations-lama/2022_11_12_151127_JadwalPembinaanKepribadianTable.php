<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class JadwalPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('jadwal_pembinaan_kepribadian', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_pembinaan_kepribadian');
				$table->date('tanggal');
				$table->time('jam_mulai');
				$table->time('jam_selesai');
				$table->string('id_instruktur',32);
				$table->string('materi_pembinaan_kepribadian',200);
				$table->string('foto',200)->nullable();
				$table->string('status', 50);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('jadwal_pembinaan_kepribadian');
		}
	}