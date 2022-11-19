<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Upt;

class UptControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexUpt()
    {
        $data = factory(Upt::class)->create();
        $this->json('GET', '/upt', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreUpt()
    {
        $data = factory(Upt::class)->create();
        $properties = [
                'id_upt' => '1' , 'uraian' => '1' , 'kanwil' => '1' , 'jenis' => '1' , 'kelas' => '1' , 'kapasitas' => '1' , 'alamat' => '1' , 'telpon' => '1' , 'fax' => '1' , 'kepala_upt' => '1' , 'jabatan_ku' => '1' , 'pangkat_ku' => '1' , 'nip_ku' => '1' , 'pejabat_upt' => '1' , 'jabatan_pu' => '1' , 'pangkat_pu' => '1' , 'nip_pu' => '1' , 'histori_remisi_tertentu' => '1' , 'dati2' => '1' , 'regf_month' => '1' , 'kapasitas_kunjungan' => '1' , 'limit_kunjungan' => '1' , 'tahun_remisi' => '1' , 'limit_tahun_remisi' => '1' , 'lap_reg_scheduler' => '1' , 'tgl_pemberlakuan_permen' => '1' , 'ip' => '1' , 'login' => '1' , 'password' => '1' , 'sdp_ada' => '1' , 'email' => '1' , 'website' => '1' , 'rupbasan_id' => '1' , 'bapas_id' => '1'
        ];
        $this->json('POST', '/upt', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowUpt()
    {
        $data = factory(Upt::class)->create();
        $this->json('GET', '/upt/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateUpt()
    {
        $data = factory(Upt::class)->create();
        $properties = [
                'id_upt' => '1' , 'uraian' => '1' , 'kanwil' => '1' , 'jenis' => '1' , 'kelas' => '1' , 'kapasitas' => '1' , 'alamat' => '1' , 'telpon' => '1' , 'fax' => '1' , 'kepala_upt' => '1' , 'jabatan_ku' => '1' , 'pangkat_ku' => '1' , 'nip_ku' => '1' , 'pejabat_upt' => '1' , 'jabatan_pu' => '1' , 'pangkat_pu' => '1' , 'nip_pu' => '1' , 'histori_remisi_tertentu' => '1' , 'dati2' => '1' , 'regf_month' => '1' , 'kapasitas_kunjungan' => '1' , 'limit_kunjungan' => '1' , 'tahun_remisi' => '1' , 'limit_tahun_remisi' => '1' , 'lap_reg_scheduler' => '1' , 'tgl_pemberlakuan_permen' => '1' , 'ip' => '1' , 'login' => '1' , 'password' => '1' , 'sdp_ada' => '1' , 'email' => '1' , 'website' => '1' , 'rupbasan_id' => '1' , 'bapas_id' => '1'
            ];
        $this->json('PATCH', '/upt/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyUpt()
    {
        $data = factory(Upt::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/upt', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
