<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class MitraTable extends Migration
	{
		public function up()
		{
			Schema::create('mitra', function (Blueprint $table) {
				
				$table->string('nama_mitra',100)->nullable();
				$table->string('nama_pic',100)->nullable();
				$table->string('alamat',200)->nullable();
				$table->string('id_dati2',32)->nullable();
				$table->string('no_telp',20)->nullable();
				$table->string('no_hp',20)->nullable();
				$table->string('email',50)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->integer('id_mitra')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('mitra');
		}
	}