<?php
namespace Database\Factories;

use App\Models\Instruktur;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstrukturFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instruktur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_instruktur' => ' - ' 
			,'id_pembinaan_kepribadian' => ' - ' 
			,'jenis_instruktur' => ' - ' 
			,'id_napi' => ' - ' 
			,'id_petugas' => ' - ' 
			,'id_mitra' => ' - ' 
			,'nama_instruktur' => ' - ' 
			,'asal_institusi_instruktur' => ' - ' 
			,'no_telp' => ' - ' 
			,'email' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}