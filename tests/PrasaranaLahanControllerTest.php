<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PrasaranaLahan;

class PrasaranaLahanControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPrasaranaLahan()
    {
        $data = factory(PrasaranaLahan::class)->create();
        $this->json('GET', '/prasaranalahan', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePrasaranaLahan()
    {
        $data = factory(PrasaranaLahan::class)->create();
        $properties = [
                'id_jenis_prasarana_lahan' => '1' , 'nama_prasarana_lahan' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/prasaranalahan', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPrasaranaLahan()
    {
        $data = factory(PrasaranaLahan::class)->create();
        $this->json('GET', '/prasaranalahan/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePrasaranaLahan()
    {
        $data = factory(PrasaranaLahan::class)->create();
        $properties = [
                'id_jenis_prasarana_lahan' => '1' , 'nama_prasarana_lahan' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/prasaranalahan/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPrasaranaLahan()
    {
        $data = factory(PrasaranaLahan::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/prasaranalahan', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
