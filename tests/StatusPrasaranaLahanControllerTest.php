<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\StatusPrasaranaLahan;

class StatusPrasaranaLahanControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexStatusPrasaranaLahan()
    {
        $data = factory(StatusPrasaranaLahan::class)->create();
        $this->json('GET', '/statusprasaranalahan', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreStatusPrasaranaLahan()
    {
        $data = factory(StatusPrasaranaLahan::class)->create();
        $properties = [
                'id_status_prasarana_lahan' => '1' , 'id_prasarana_lahan' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'luas_dipakai' => '1' , 'lahan_tidur' => '1' , 'satuan' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/statusprasaranalahan', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowStatusPrasaranaLahan()
    {
        $data = factory(StatusPrasaranaLahan::class)->create();
        $this->json('GET', '/statusprasaranalahan/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateStatusPrasaranaLahan()
    {
        $data = factory(StatusPrasaranaLahan::class)->create();
        $properties = [
                'id_status_prasarana_lahan' => '1' , 'id_prasarana_lahan' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'luas_dipakai' => '1' , 'lahan_tidur' => '1' , 'satuan' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/statusprasaranalahan/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyStatusPrasaranaLahan()
    {
        $data = factory(StatusPrasaranaLahan::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/statusprasaranalahan', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
