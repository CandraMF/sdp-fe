<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Provinsi;

class ProvinsiControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexProvinsi()
    {
        $data = factory(Provinsi::class)->create();
        $this->json('GET', '/provinsi', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreProvinsi()
    {
        $data = factory(Provinsi::class)->create();
        $properties = [
                'id_provinsi' => '1' , 'deskripsi' => '1' , 'status_download' => '1' , 'id_bps' => '1' , 'id_negara' => '1'
        ];
        $this->json('POST', '/provinsi', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowProvinsi()
    {
        $data = factory(Provinsi::class)->create();
        $this->json('GET', '/provinsi/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateProvinsi()
    {
        $data = factory(Provinsi::class)->create();
        $properties = [
                'id_provinsi' => '1' , 'deskripsi' => '1' , 'status_download' => '1' , 'id_bps' => '1' , 'id_negara' => '1'
            ];
        $this->json('PATCH', '/provinsi/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyProvinsi()
    {
        $data = factory(Provinsi::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/provinsi', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
