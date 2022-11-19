<?php
namespace Database\Factories;

use App\Models\Dati2;
use Illuminate\Database\Eloquent\Factories\Factory;

class Dati2Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dati2::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_dati2' => ' - ' 
			,'deskripsi' => ' - ' 
			,'id_provinsi' => ' - ' 
			,'status' => ' - ' 
			,'status_download' => ' - ' 
			,'id_bps' => ' - ' 
			
        ];
    }

}