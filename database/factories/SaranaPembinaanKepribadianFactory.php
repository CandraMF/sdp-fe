<?php
namespace Database\Factories;

use App\Models\SaranaPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaranaPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaranaPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_sarana' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}