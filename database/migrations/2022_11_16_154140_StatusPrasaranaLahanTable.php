<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class StatusPrasaranaLahanTable extends Migration
	{
		public function up()
		{
			Schema::create('status_prasarana_lahan', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_prasarana_lahan');
				$table->date('tanggal');
				$table->enum('status',['TIDUR', 'DIMANFAATKAN', 'SENGKETA', 'DISEWAKAN']);			
				$table->enum('kepemilikan',['UPT', 'KANWIL', 'DITJEN', 'KEMENTERIAN', 'MITRA']);			
				$table->decimal('luas_dipakai',6, 0);
				$table->decimal('lahan_tidur',6, 0);
				$table->string('satuan',50);
				$table->string('foto',200);
				$table->string('keterangan',200)->nullable();
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('status_prasarana_lahan');
		}
	}