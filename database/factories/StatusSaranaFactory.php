<?php
namespace Database\Factories;

use App\Models\StatusSarana;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusSaranaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StatusSarana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_status_sarana' => ' - ' 
			,'id_sarana' => ' - ' 
			,'tahun' => ' - ' 
			,'bulan' => ' - ' 
			,'status' => ' - ' 
			,'kepemilkan' => ' - ' 
			,'jumlah' => ' - ' 
			,'satuan' => ' - ' 
			,'kondisi_baik' => ' - ' 
			,'kondisi_rusak' => ' - ' 
			,'foto' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}