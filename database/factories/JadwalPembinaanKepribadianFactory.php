<?php
namespace Database\Factories;

use App\Models\JadwalPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JadwalPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_jadwal_pk' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'hari' => ' - ' 
			,'tanggal' => ' - ' 
			,'jam_mulai' => ' - ' 
			,'jam_selesai' => ' - ' 
			,'id_instruktur' => ' - ' 
			,'materi_pembinaan_kepribadian' => ' - ' 
			,'foto' => ' - ' 
			,'status' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}