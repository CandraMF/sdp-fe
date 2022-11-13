<?php
namespace Database\Factories;

use App\Models\Mitra;
use Illuminate\Database\Eloquent\Factories\Factory;

class MitraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mitra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_mitra' => ' - ' 
			,'nama_mitra' => ' - ' 
			,'nama_pic' => ' - ' 
			,'alamat' => ' - ' 
			,'id_dati2' => ' - ' 
			,'no_telp' => ' - ' 
			,'no_hp' => ' - ' 
			,'email' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}