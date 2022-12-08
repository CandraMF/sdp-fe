<?php
namespace Database\Factories;

use App\Models\InstrukturPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrukturPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstrukturPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_instruktur' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}