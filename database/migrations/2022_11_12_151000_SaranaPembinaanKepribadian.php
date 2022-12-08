<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class SaranaPembinaanKepribadianTable extends Migration
	{
		public function up()
		{
			Schema::create('sarana_pembinaan_kepribadian', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_sarana');
				$table->integer('id_pembinaan_kepribadian');
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('sarana_pembinaan_kepribadian');
		}
	}