<?php
namespace Database\Factories;

use App\Models\Upt;
use Illuminate\Database\Eloquent\Factories\Factory;

class UptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Upt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_upt' => ' - ' 
			,'uraian' => ' - ' 
			,'kanwil' => ' - ' 
			,'jenis' => ' - ' 
			,'kelas' => ' - ' 
			,'kapasitas' => ' - ' 
			,'alamat' => ' - ' 
			,'telpon' => ' - ' 
			,'fax' => ' - ' 
			,'kepala_upt' => ' - ' 
			,'jabatan_ku' => ' - ' 
			,'pangkat_ku' => ' - ' 
			,'nip_ku' => ' - ' 
			,'pejabat_upt' => ' - ' 
			,'jabatan_pu' => ' - ' 
			,'pangkat_pu' => ' - ' 
			,'nip_pu' => ' - ' 
			,'histori_remisi_tertentu' => ' - ' 
			,'dati2' => ' - ' 
			,'regf_month' => ' - ' 
			,'kapasitas_kunjungan' => ' - ' 
			,'limit_kunjungan' => ' - ' 
			,'tahun_remisi' => ' - ' 
			,'limit_tahun_remisi' => ' - ' 
			,'lap_reg_scheduler' => ' - ' 
			,'tgl_pemberlakuan_permen' => ' - ' 
			,'ip' => ' - ' 
			,'login' => ' - ' 
			,'password' => ' - ' 
			,'sdp_ada' => ' - ' 
			,'email' => ' - ' 
			,'website' => ' - ' 
			,'rupbasan_id' => ' - ' 
			,'bapas_id' => ' - ' 
			
        ];
    }

}