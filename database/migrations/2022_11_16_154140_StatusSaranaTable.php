<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class StatusSaranaTable extends Migration
	{
		public function up()
		{
			Schema::create('status_sarana', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('id_sarana');
				$table->date('tanggal');
				$table->enum('status',['AKTIF', 'TIDAK AKTIF', 'SEBAGIAN']);			
				$table->enum('kepemilikan',['UPT', 'KANWIL', 'DITJEN', 'KEMENTERIAN', 'MITRA']);			
				$table->integer('jumlah');
				$table->string('satuan',50);
				$table->integer('kondisi_baik');
				$table->integer('kondisi_rusak');
				$table->string('foto',200);
				$table->string('keterangan',200)->nullable();
				$table->dateTime('updated_at');
				$table->string('updated_by',32);
				
			});
		}

		public function down()
		{
			Schema::dropIfExists('status_sarana');
		}
	}