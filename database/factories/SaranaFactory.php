<?php
namespace Database\Factories;

use App\Models\Sarana;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaranaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sarana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_jenis_sarana' => ' - ' 
			,'nama_sarana' => ' - ' 
			,'id_upt' => ' - ' 
			,'tgl_pengadaan' => ' - ' 
			,'keterangan' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}