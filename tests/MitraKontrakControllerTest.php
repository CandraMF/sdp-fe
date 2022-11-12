<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\MitraKontrak;

class MitraKontrakControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexMitraKontrak()
    {
        $data = factory(MitraKontrak::class)->create();
        $this->json('GET', '/mitrakontrak', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreMitraKontrak()
    {
        $data = factory(MitraKontrak::class)->create();
        $properties = [
                'id_kontrak' => '1' , 'id_mitra' => '1' , 'jenis_mitra' => '1' , 'kontrak_dengan' => '1' , 'id_kanwil' => '1' , 'id_upt' => '1' , 'nomor_kontrak' => '1' , 'kontrak_awal' => '1' , 'kontrak_akhir' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/mitrakontrak', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowMitraKontrak()
    {
        $data = factory(MitraKontrak::class)->create();
        $this->json('GET', '/mitrakontrak/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateMitraKontrak()
    {
        $data = factory(MitraKontrak::class)->create();
        $properties = [
                'id_kontrak' => '1' , 'id_mitra' => '1' , 'jenis_mitra' => '1' , 'kontrak_dengan' => '1' , 'id_kanwil' => '1' , 'id_upt' => '1' , 'nomor_kontrak' => '1' , 'kontrak_awal' => '1' , 'kontrak_akhir' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/mitrakontrak/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyMitraKontrak()
    {
        $data = factory(MitraKontrak::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/mitrakontrak', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
