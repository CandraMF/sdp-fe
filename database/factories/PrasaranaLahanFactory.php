<?php
namespace Database\Factories;

use App\Models\PrasaranaLahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrasaranaLahanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrasaranaLahan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_jenis_prasarana_lahan' => ' - ' 
			,'nama_prasarana_lahan' => ' - ' 
			,'id_upt' => ' - ' 
			,'tgl_pengadaan' => ' - ' 
			,'keterangan' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}