<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class SaranaTable extends Migration
	{
		public function up()
		{
			Schema::create('sarana', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('id_jenis_sarana',32);
				$table->string('nama_sarana',100);
				$table->string('id_upt',32);
				$table->date('tgl_pengadaan');
				$table->string('keterangan',200)->nullable();
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('sarana');
		}
	}