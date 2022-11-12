<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\JadwalPembinaanKepribadian;

class JadwalPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexJadwalPembinaanKepribadian()
    {
        $data = factory(JadwalPembinaanKepribadian::class)->create();
        $this->json('GET', '/jadwalpembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreJadwalPembinaanKepribadian()
    {
        $data = factory(JadwalPembinaanKepribadian::class)->create();
        $properties = [
                'id_jadwal_pk' => '1' , 'id_pembinaan_kepribadian' => '1' , 'hari' => '1' , 'tanggal' => '1' , 'jam_mulai' => '1' , 'jam_selesai' => '1' , 'id_instruktur' => '1' , 'materi_pembinaan_kepribadian' => '1' , 'foto' => '1' , 'status' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/jadwalpembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowJadwalPembinaanKepribadian()
    {
        $data = factory(JadwalPembinaanKepribadian::class)->create();
        $this->json('GET', '/jadwalpembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateJadwalPembinaanKepribadian()
    {
        $data = factory(JadwalPembinaanKepribadian::class)->create();
        $properties = [
                'id_jadwal_pk' => '1' , 'id_pembinaan_kepribadian' => '1' , 'hari' => '1' , 'tanggal' => '1' , 'jam_mulai' => '1' , 'jam_selesai' => '1' , 'id_instruktur' => '1' , 'materi_pembinaan_kepribadian' => '1' , 'foto' => '1' , 'status' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/jadwalpembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyJadwalPembinaanKepribadian()
    {
        $data = factory(JadwalPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/jadwalpembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
