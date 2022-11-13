<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\DaftarPesertaPembinaanKepribadian;

class DaftarPesertaPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexDaftarPesertaPembinaanKepribadian()
    {
        $data = factory(DaftarPesertaPembinaanKepribadian::class)->create();
        $this->json('GET', '/daftarpesertapembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreDaftarPesertaPembinaanKepribadian()
    {
        $data = factory(DaftarPesertaPembinaanKepribadian::class)->create();
        $properties = [
                'id_daftar_ppk' => '1' , 'id_jadwal_pk' => '1' , 'id_peserta' => '1' , 'status' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1' , 'verifikasi_oleh' => '1'
        ];
        $this->json('POST', '/daftarpesertapembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowDaftarPesertaPembinaanKepribadian()
    {
        $data = factory(DaftarPesertaPembinaanKepribadian::class)->create();
        $this->json('GET', '/daftarpesertapembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateDaftarPesertaPembinaanKepribadian()
    {
        $data = factory(DaftarPesertaPembinaanKepribadian::class)->create();
        $properties = [
                'id_daftar_ppk' => '1' , 'id_jadwal_pk' => '1' , 'id_peserta' => '1' , 'status' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1' , 'verifikasi_oleh' => '1'
            ];
        $this->json('PATCH', '/daftarpesertapembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyDaftarPesertaPembinaanKepribadian()
    {
        $data = factory(DaftarPesertaPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/daftarpesertapembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
