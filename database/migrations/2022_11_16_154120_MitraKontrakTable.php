<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class MitraKontrakTable extends Migration
	{
		public function up()
		{
			Schema::create('mitra_kontrak', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('id_mitra',32);
				$table->string('jenis_mitra',32);
				$table->enum('kontrak_dengan',['DITJEN', 'KANWIL', 'UPT']);
				$table->integer('id_kanwil')->nullable();
				$table->integer('id_upt')->nullable();
				$table->string('nomor_kontrak',200);
				$table->date('kontrak_awal');
				$table->date('kontrak_akhir');
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('mitra_kontrak');
		}
	}