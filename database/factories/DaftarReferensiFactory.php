<?php
namespace Database\Factories;

use App\Models\DaftarReferensi;
use Illuminate\Database\Eloquent\Factories\Factory;

class DaftarReferensiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DaftarReferensi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_lookup' => ' - ' 
			,'groups' => ' - ' 
			,'deskripsi' => ' - ' 
			,'catatan' => ' - ' 
			,'content' => ' - ' 
			,'status_download' => ' - ' 
			
        ];
    }

}