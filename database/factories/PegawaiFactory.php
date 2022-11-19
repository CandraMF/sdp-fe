<?php
namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_pegawai' => ' - ' 
			,'nip' => ' - ' 
			,'nama' => ' - ' 
			,'id_tempat_lahir' => ' - ' 
			,'tempat_lahir_lain' => ' - ' 
			,'tgl_lahir' => ' - ' 
			,'id_jenis_kelamin' => ' - ' 
			,'alamat' => ' - ' 
			,'jabatan' => ' - ' 
			,'pangkat' => ' - ' 
			,'golongan' => ' - ' 
			,'bagian' => ' - ' 
			,'email' => ' - ' 
			,'telepon' => ' - ' 
			,'foto' => ' - ' 
			,'id_upt' => ' - ' 
			,'konsolidasi' => ' - ' 
			,'is_active' => ' - ' 
			,'is_pk' => ' - ' 
			,'id_pengunjung_finger' => ' - ' 
			,'is_deleted' => ' - ' 
			,'created' => ' - ' 
			,'created_by' => ' - ' 
			,'updated' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}