<?php
namespace Database\Factories;

use App\Models\PesertaPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesertaPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PesertaPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_daftar_pembinaan_kepribadian' => ' - ' 
			,'id_wbp' => ' - ' 
			,'kehadiran' => ' - ' 
			,'no_sertifikat' => ' - ' 
			,'file_sertifikat' => ' - ' 
			,'nilai' => ' - ' 
			,'predikat' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}