<?php
namespace Database\Factories;

use App\Models\DaftarPesertaPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class DaftarPesertaPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DaftarPesertaPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_daftar_ppk' => ' - ' 
			,'id_jadwal_pk' => ' - ' 
			,'id_peserta' => ' - ' 
			,'status' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			,'verifikasi_oleh' => ' - ' 
			
        ];
    }

}