<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class StatusSaranaTable extends Migration
	{
		public function up()
		{
			Schema::create('status_sarana', function (Blueprint $table) {
				
				$table->integer('id_sarana')->nullable();
				$table->integer('tahun')->nullable();
				$table->string('bulan',50)->nullable();
				$table->string('status',50)->nullable();
				$table->string('kepemilkan',50)->nullable();
				$table->integer('jumlah')->nullable();
				$table->string('satuan',50)->nullable();
				$table->integer('kondisi_baik')->nullable();
				$table->integer('kondisi_rusak')->nullable();
				$table->string('foto',200)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->integer('id_status_sarana')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('status_sarana');
		}
	}