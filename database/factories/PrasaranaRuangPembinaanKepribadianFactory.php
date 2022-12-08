<?php
namespace Database\Factories;

use App\Models\PrasaranaRuangPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrasaranaRuangPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrasaranaRuangPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_prasarana_ruang' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}