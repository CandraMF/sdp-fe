<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class MitraKontrakTable extends Migration
	{
		public function up()
		{
			Schema::create('mitra_kontrak', function (Blueprint $table) {
				
				$table->string('id_mitra',32)->nullable();
				$table->string('jenis_mitra',32)->nullable();
				$table->string('kontrak_dengan',100)->nullable();
				$table->integer('id_kanwil')->nullable();
				$table->integer('id_upt')->nullable();
				$table->string('nomor_kontrak',200)->nullable();
				$table->date('kontrak_awal')->nullable();
				$table->date('kontrak_akhir')->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->bigIncrements('id_kontrak')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('mitra_kontrak');
		}
	}