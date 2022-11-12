<?php
namespace Database\Factories;

use App\Models\MitraKontrak;
use Illuminate\Database\Eloquent\Factories\Factory;

class MitraKontrakFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MitraKontrak::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_kontrak' => ' - ' 
			,'id_mitra' => ' - ' 
			,'jenis_mitra' => ' - ' 
			,'kontrak_dengan' => ' - ' 
			,'id_kanwil' => ' - ' 
			,'id_upt' => ' - ' 
			,'nomor_kontrak' => ' - ' 
			,'kontrak_awal' => ' - ' 
			,'kontrak_akhir' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}