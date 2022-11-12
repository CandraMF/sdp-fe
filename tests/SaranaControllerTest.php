<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Sarana;

class SaranaControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexSarana()
    {
        $data = factory(Sarana::class)->create();
        $this->json('GET', '/sarana', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreSarana()
    {
        $data = factory(Sarana::class)->create();
        $properties = [
                'id_sarana' => '1' , 'id_jenis_sarana' => '1' , 'nama_sarana' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/sarana', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowSarana()
    {
        $data = factory(Sarana::class)->create();
        $this->json('GET', '/sarana/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateSarana()
    {
        $data = factory(Sarana::class)->create();
        $properties = [
                'id_sarana' => '1' , 'id_jenis_sarana' => '1' , 'nama_sarana' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/sarana/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroySarana()
    {
        $data = factory(Sarana::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/sarana', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
