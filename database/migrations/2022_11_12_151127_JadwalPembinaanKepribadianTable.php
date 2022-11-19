<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class JadwalPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('jadwal_pembinaan_kepribadian', function (Blueprint $table) {
				
				$table->integer('id_pembinaan_kepribadian')->nullable();
				$table->string('hari',50)->nullable();
				$table->date('tanggal')->nullable();
				$table->time('jam_mulai')->nullable();
				$table->time('jam_selesai')->nullable();
				$table->string('id_instruktur',32)->nullable();
				$table->string('materi_pembinaan_kepribadian',200)->nullable();
				$table->string('foto',200)->nullable();
				$table->string('status',50)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_jadwal_pk')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('jadwal_pembinaan_kepribadian');
		}
	}