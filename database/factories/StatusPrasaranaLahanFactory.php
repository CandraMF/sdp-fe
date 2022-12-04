<?php
namespace Database\Factories;

use App\Models\StatusPrasaranaLahan;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusPrasaranaLahanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StatusPrasaranaLahan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_prasarana_lahan' => ' - ' 
			,'tanggal' => ' - ' 
			,'status' => ' - ' 
			,'kepemilikan' => ' - ' 
			,'luas_dipakai' => ' - ' 
			,'lahan_tidur' => ' - ' 
			,'satuan' => ' - ' 
			,'foto' => ' - ' 
			,'keterangan' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}