<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Dati2;

class Dati2ControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexDati2()
    {
        $data = factory(Dati2::class)->create();
        $this->json('GET', '/dati2', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreDati2()
    {
        $data = factory(Dati2::class)->create();
        $properties = [
                'id_dati2' => '1' , 'deskripsi' => '1' , 'id_provinsi' => '1' , 'status' => '1' , 'status_download' => '1' , 'id_bps' => '1'
        ];
        $this->json('POST', '/dati2', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowDati2()
    {
        $data = factory(Dati2::class)->create();
        $this->json('GET', '/dati2/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateDati2()
    {
        $data = factory(Dati2::class)->create();
        $properties = [
                'id_dati2' => '1' , 'deskripsi' => '1' , 'id_provinsi' => '1' , 'status' => '1' , 'status_download' => '1' , 'id_bps' => '1'
            ];
        $this->json('PATCH', '/dati2/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyDati2()
    {
        $data = factory(Dati2::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/dati2', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
