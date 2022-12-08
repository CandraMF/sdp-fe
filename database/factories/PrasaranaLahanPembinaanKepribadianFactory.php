<?php
namespace Database\Factories;

use App\Models\PrasaranaLahanPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrasaranaLahanPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrasaranaLahanPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_prasarana_lahan' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}