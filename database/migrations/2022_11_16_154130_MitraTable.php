<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class MitraTable extends Migration
	{
		public function up()
		{
			Schema::create('mitra', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('nama_mitra',100);
				$table->string('nama_pic',100);
				$table->string('alamat',200);
				$table->string('id_dati2',32);
				$table->string('no_telp',20)->nullable();
				$table->string('no_hp',20);
				$table->string('email',50);
				$table->string('keterangan',200)->nullable();
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('mitra');
		}
	}