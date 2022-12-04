<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class PrasaranaLahanTable extends Migration
	{
		public function up()
		{
			Schema::create('prasarana_lahan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('id_jenis_prasarana_lahan',32);
				$table->string('nama_prasarana_lahan',100);
				$table->string('id_upt',32);
				$table->date('tgl_pengadaan');
				$table->string('keterangan',200);
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('prasarana_lahan');
		}
	}