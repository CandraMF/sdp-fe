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
        	'id_status_prasarana_lahan' => ' - ' 
			,'id_prasarana_lahan' => ' - ' 
			,'tahun' => ' - ' 
			,'bulan' => ' - ' 
			,'status' => ' - ' 
			,'kepemilkan' => ' - ' 
			,'luas_dipakai' => ' - ' 
			,'lahan_tidur' => ' - ' 
			,'satuan' => ' - ' 
			,'foto' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}