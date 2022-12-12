<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class InstrukturPelatihanKeterampilanTable extends Migration
	{
		public function up()
		{
			Schema::create('instruktur_pelatihan_keterampilan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_instruktur');
				$table->integer('id_pelatihan_keterampilan');
				$table->dateTime('updated_at');
				$table->string('updated_by',32);				
			});
		}

		public function down()
		{
			Schema::dropIfExists('instruktur_pelatihan_keterampilan');
		}
	}