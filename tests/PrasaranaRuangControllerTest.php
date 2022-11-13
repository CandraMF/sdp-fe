<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PrasaranaRuang;

class PrasaranaRuangControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPrasaranaRuang()
    {
        $data = factory(PrasaranaRuang::class)->create();
        $this->json('GET', '/prasaranaruang', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePrasaranaRuang()
    {
        $data = factory(PrasaranaRuang::class)->create();
        $properties = [
                'id_prasarana_ruang' => '1' , 'id_jenis_prasarana_ruang' => '1' , 'nama_prasarana_ruang' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/prasaranaruang', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPrasaranaRuang()
    {
        $data = factory(PrasaranaRuang::class)->create();
        $this->json('GET', '/prasaranaruang/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePrasaranaRuang()
    {
        $data = factory(PrasaranaRuang::class)->create();
        $properties = [
                'id_prasarana_ruang' => '1' , 'id_jenis_prasarana_ruang' => '1' , 'nama_prasarana_ruang' => '1' , 'id_upt' => '1' , 'tgl_pengadaan' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/prasaranaruang/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPrasaranaRuang()
    {
        $data = factory(PrasaranaRuang::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/prasaranaruang', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
