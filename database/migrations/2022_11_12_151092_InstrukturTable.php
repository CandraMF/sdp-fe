<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class InstrukturTable extends Migration
	{
		public function up()
		{
			Schema::create('instruktur', function (Blueprint $table) {
				
				$table->integer('id_pembinaan_kepribadian')->nullable();
				$table->string('jenis_instruktur',50)->nullable();
				$table->string('id_napi',32)->nullable();
				$table->string('id_petugas',32)->nullable();
				$table->integer('id_mitra')->nullable();
				$table->string('nama_instruktur',100)->nullable();
				$table->string('asal_institusi_instruktur',100)->nullable();
				$table->string('no_telp',20)->nullable();
				$table->string('email',100)->nullable();
				$table->string('keterangan',200)->nullable();
				$table->dateTime('update_terakhir')->nullable();
				$table->string('update_oleh',32)->nullable();
				$table->integer('id_instruktur')->primary();
			});
		}

		public function down()
		{
			Schema::dropIfExists('instruktur');
		}
	}