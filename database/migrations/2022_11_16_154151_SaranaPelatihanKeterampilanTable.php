<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class SaranaPelatihanKeterampilanTable extends Migration
	{
		public function up()
		{
			Schema::create('sarana_pelatihan_keterampilan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_sarana');
				$table->integer('id_pelatihan_keterampilan');
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('sarana_pelatihan_keterampilan');
		}
	}