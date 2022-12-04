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
        	'id_pembinaan_kepribadian' => ' - ' 
			,'tanggal' => ' - ' 
			,'jam_mulai' => ' - ' 
			,'jam_selesai' => ' - ' 
			,'id_instruktur' => ' - ' 
			,'materi_pembinaan_kepribadian' => ' - ' 
			,'foto' => ' - ' 
			,'status' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}