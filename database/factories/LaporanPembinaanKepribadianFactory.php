<?php
namespace Database\Factories;

use App\Models\LaporanPembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanPembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LaporanPembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_pembinaan_kepribadian' => ' - ' 
			,'id_upt' => ' - ' 
			,'periode' => ' - ' 
			,'jumlah_hari' => ' - ' 
			,'jumlah_pembinaan_kepribadian' => ' - ' 
			,'jumlah_peserta' => ' - ' 
			,'jumlah_instruktur_petugas' => ' - ' 
			,'jumlah_instruktur_napi' => ' - ' 
			,'jumlah_instruktur_instansi_lain' => ' - ' 
			,'jumlah_instruktur_mitra' => ' - ' 
			,'keterangan' => ' - ' 
			,'status' => ' - ' 
			,'verifikasi_upt' => ' - ' 
			,'verifikasi_kanwil' => ' - ' 
			,'verifikasi_ditjen' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}