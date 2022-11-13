<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\StatusSarana;

class StatusSaranaControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexStatusSarana()
    {
        $data = factory(StatusSarana::class)->create();
        $this->json('GET', '/statussarana', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreStatusSarana()
    {
        $data = factory(StatusSarana::class)->create();
        $properties = [
                'id_status_sarana' => '1' , 'id_sarana' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'jumlah' => '1' , 'satuan' => '1' , 'kondisi_baik' => '1' , 'kondisi_rusak' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/statussarana', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowStatusSarana()
    {
        $data = factory(StatusSarana::class)->create();
        $this->json('GET', '/statussarana/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateStatusSarana()
    {
        $data = factory(StatusSarana::class)->create();
        $properties = [
                'id_status_sarana' => '1' , 'id_sarana' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'jumlah' => '1' , 'satuan' => '1' , 'kondisi_baik' => '1' , 'kondisi_rusak' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/statussarana/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyStatusSarana()
    {
        $data = factory(StatusSarana::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/statussarana', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
