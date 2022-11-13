<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PrasaranaLahanTable extends Migration
	{
		public function up()
		{
			Schema::create('prasarana_lahan', function (Blueprint $table) {
				
				$table->string('id_jenis_prasarana_lahan',32)->nullable();
				$table->string('nama_prasarana_lahan',100)->nullable();
				$table->string('id_upt',32)->nullable();
				$table->date('tgl_pengadaan')->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->integer('id_prasarana_lahan')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('prasarana_lahan');
		}
	}