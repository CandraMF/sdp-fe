<?php
namespace Database\Factories;

use App\Models\StatusPrasaranaRuang;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusPrasaranaRuangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StatusPrasaranaRuang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_status_prasarana_ruang' => ' - ' 
			,'id_prasarana_ruang' => ' - ' 
			,'tahun' => ' - ' 
			,'bulan' => ' - ' 
			,'status' => ' - ' 
			,'kepemilkan' => ' - ' 
			,'luas' => ' - ' 
			,'satuan_luas' => ' - ' 
			,'jumlah_lantai' => ' - ' 
			,'jumlah_ruang' => ' - ' 
			,'kondisi_baik' => ' - ' 
			,'kondisi_rusak' => ' - ' 
			,'satuan_kondisi' => ' - ' 
			,'foto' => ' - ' 
			,'pendaftaran_disnaker' => ' - ' 
			,'catatan_disnaker' => ' - ' 
			,'keterangan' => ' - ' 
			,'update_terakhir' => ' - ' 
			,'update_oleh' => ' - ' 
			
        ];
    }

}