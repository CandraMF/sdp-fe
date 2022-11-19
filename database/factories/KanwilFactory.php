<?php
namespace Database\Factories;

use App\Models\Kanwil;
use Illuminate\Database\Eloquent\Factories\Factory;

class KanwilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kanwil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'kode' => ' - ' 
			,'uraian' => ' - ' 
			,'sdp_ada' => ' - ' 
			,'alamat' => ' - ' 
			,'telpon' => ' - ' 
			,'fax' => ' - ' 
			,'kepala_kanwil' => ' - ' 
			,'jabatan_kw' => ' - ' 
			,'pangkat_kw' => ' - ' 
			,'nip_kw' => ' - ' 
			,'pejabat_kanwil' => ' - ' 
			,'jabatan_pw' => ' - ' 
			,'pangkat_pw' => ' - ' 
			,'nip_pw' => ' - ' 
			,'ip' => ' - ' 
			,'login' => ' - ' 
			,'password' => ' - ' 
			,'id_provinsi' => ' - ' 
			,'id_dati2' => ' - ' 
			,'status_download' => ' - ' 
			,'email' => ' - ' 
			,'website' => ' - ' 
			,'konsolidasi' => ' - ' 
			,'is_konsolidasi_offline' => ' - ' 
			,'nama_aplikasi' => ' - ' 
			,'pin' => ' - ' 
			,'id_timezone' => ' - ' 
			,'versions' => ' - ' 
			,'versions_date' => ' - ' 
			,'backup_scheduler' => ' - ' 
			,'lap_reg_scheduler' => ' - ' 
			,'konsolidasi_scheduler' => ' - ' 
			,'konsolidasi_scheduler_interval' => ' - ' 
			,'konsolidasi_integrasi_scheduler' => ' - ' 
			,'terima_data_integrasi_scheduler' => ' - ' 
			,'terima_data_integrasi_scheduler_interval' => ' - ' 
			,'increament_backup_number' => ' - ' 
			,'increament_backup_time' => ' - ' 
			
        ];
    }

}