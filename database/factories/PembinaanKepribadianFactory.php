<?php
namespace Database\Factories;

use App\Models\PembinaanKepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembinaanKepribadianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PembinaanKepribadian::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        	'id_jenis_pembinaan_kepribadian' => ' - ' 
			,'id_upt' => ' - ' 
			,'id_mitra' => ' - ' 
			,'nama_program' => ' - ' 
			,'program_wajib' => ' - ' 
			,'materi_pembinaan_kepribadian' => ' - ' 
			,'id_instruktur' => ' - ' 
			,'penangung_jawab' => ' - ' 
			,'tanggal_mulai' => ' - ' 
			,'tanggal_selesai' => ' - ' 
			,'tempat_pelaksanaan' => ' - ' 
			,'perlu_kelulusan' => ' - ' 
			,'id_sarana' => ' - ' 
			,'id_prasarana' => ' - ' 
			,'realisasi_anggaran' => ' - ' 
			,'id_jenis_anggaran' => ' - ' 
			,'foto' => ' - ' 
			,'keterangan' => ' - ' 
			,'status' => ' - ' 
			,'updated_by' => ' - ' 
			
        ];
    }

}