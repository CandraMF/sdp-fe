<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Kanwil;

class KanwilControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexKanwil()
    {
        $data = factory(Kanwil::class)->create();
        $this->json('GET', '/kanwil', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreKanwil()
    {
        $data = factory(Kanwil::class)->create();
        $properties = [
                'kode' => '1' , 'uraian' => '1' , 'sdp_ada' => '1' , 'alamat' => '1' , 'telpon' => '1' , 'fax' => '1' , 'kepala_kanwil' => '1' , 'jabatan_kw' => '1' , 'pangkat_kw' => '1' , 'nip_kw' => '1' , 'pejabat_kanwil' => '1' , 'jabatan_pw' => '1' , 'pangkat_pw' => '1' , 'nip_pw' => '1' , 'ip' => '1' , 'login' => '1' , 'password' => '1' , 'id_provinsi' => '1' , 'id_dati2' => '1' , 'status_download' => '1' , 'email' => '1' , 'website' => '1' , 'konsolidasi' => '1' , 'is_konsolidasi_offline' => '1' , 'nama_aplikasi' => '1' , 'pin' => '1' , 'id_timezone' => '1' , 'versions' => '1' , 'versions_date' => '1' , 'backup_scheduler' => '1' , 'lap_reg_scheduler' => '1' , 'konsolidasi_scheduler' => '1' , 'konsolidasi_scheduler_interval' => '1' , 'konsolidasi_integrasi_scheduler' => '1' , 'terima_data_integrasi_scheduler' => '1' , 'terima_data_integrasi_scheduler_interval' => '1' , 'increament_backup_number' => '1' , 'increament_backup_time' => '1'
        ];
        $this->json('POST', '/kanwil', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowKanwil()
    {
        $data = factory(Kanwil::class)->create();
        $this->json('GET', '/kanwil/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateKanwil()
    {
        $data = factory(Kanwil::class)->create();
        $properties = [
                'kode' => '1' , 'uraian' => '1' , 'sdp_ada' => '1' , 'alamat' => '1' , 'telpon' => '1' , 'fax' => '1' , 'kepala_kanwil' => '1' , 'jabatan_kw' => '1' , 'pangkat_kw' => '1' , 'nip_kw' => '1' , 'pejabat_kanwil' => '1' , 'jabatan_pw' => '1' , 'pangkat_pw' => '1' , 'nip_pw' => '1' , 'ip' => '1' , 'login' => '1' , 'password' => '1' , 'id_provinsi' => '1' , 'id_dati2' => '1' , 'status_download' => '1' , 'email' => '1' , 'website' => '1' , 'konsolidasi' => '1' , 'is_konsolidasi_offline' => '1' , 'nama_aplikasi' => '1' , 'pin' => '1' , 'id_timezone' => '1' , 'versions' => '1' , 'versions_date' => '1' , 'backup_scheduler' => '1' , 'lap_reg_scheduler' => '1' , 'konsolidasi_scheduler' => '1' , 'konsolidasi_scheduler_interval' => '1' , 'konsolidasi_integrasi_scheduler' => '1' , 'terima_data_integrasi_scheduler' => '1' , 'terima_data_integrasi_scheduler_interval' => '1' , 'increament_backup_number' => '1' , 'increament_backup_time' => '1'
            ];
        $this->json('PATCH', '/kanwil/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyKanwil()
    {
        $data = factory(Kanwil::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/kanwil', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
