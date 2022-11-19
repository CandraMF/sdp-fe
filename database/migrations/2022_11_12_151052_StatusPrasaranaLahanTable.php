<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class StatusPrasaranaLahanTable extends Migration
	{
		public function up()
		{
			Schema::create('status_prasarana_lahan', function (Blueprint $table) {
				
				$table->integer('id_prasarana_lahan')->nullable();
				$table->integer('tahun')->nullable();
				$table->string('bulan',50)->nullable();
				$table->string('status',50)->nullable();
				$table->string('kepemilkan',50)->nullable();
				$table->decimal('luas_dipakai',6, 2)->nullable();
				$table->decimal('lahan_tidur',6, 2)->nullable();
				$table->string('satuan',50)->nullable();
				$table->string('foto',200)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_status_prasarana_lahan')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('status_prasarana_lahan');
		}
	}