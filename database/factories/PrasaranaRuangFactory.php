<?php
namespace Database\Factories;

use App\Models\PrasaranaRuang;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrasaranaRuangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrasaranaRuang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_jenis_prasarana_ruang' => ' - ' 
			,'nama_prasarana_ruang' => ' - ' 
			,'id_upt' => ' - ' 
			,'tgl_pengadaan' => ' - ' 
			,'keterangan' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}