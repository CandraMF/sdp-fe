<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class InstrukturTable extends Migration
	{
		public function up()
		{
			Schema::create('instruktur', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_pembinaan_kepribadian');
				$table->string('jenis_instruktur', 50);
				$table->string('id_napi',32)->nullable();
				$table->string('id_petugas',32)->nullable();
				$table->integer('id_mitra')->nullable();
				$table->string('nama_instruktur',100);
				$table->string('asal_institusi_instruktur',100)->nullable();
				$table->string('no_telp',20)->nullable();
				$table->string('email',100)->nullable();
				$table->string('keterangan',200);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('instruktur');
		}
	}