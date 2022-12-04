<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Mitra;

class MitraControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexMitra()
    {
        $data = factory(Mitra::class)->create();
        $this->json('GET', '/mitra', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreMitra()
    {
        $data = factory(Mitra::class)->create();
        $properties = [
                'nama_mitra' => '1' , 'nama_pic' => '1' , 'alamat' => '1' , 'id_dati2' => '1' , 'no_telp' => '1' , 'no_hp' => '1' , 'email' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/mitra', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowMitra()
    {
        $data = factory(Mitra::class)->create();
        $this->json('GET', '/mitra/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateMitra()
    {
        $data = factory(Mitra::class)->create();
        $properties = [
                'nama_mitra' => '1' , 'nama_pic' => '1' , 'alamat' => '1' , 'id_dati2' => '1' , 'no_telp' => '1' , 'no_hp' => '1' , 'email' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/mitra/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyMitra()
    {
        $data = factory(Mitra::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/mitra', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
