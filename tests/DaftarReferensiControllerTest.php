<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\DaftarReferensi;

class DaftarReferensiControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexDaftarReferensi()
    {
        $data = factory(DaftarReferensi::class)->create();
        $this->json('GET', '/daftarreferensi', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreDaftarReferensi()
    {
        $data = factory(DaftarReferensi::class)->create();
        $properties = [
                'id_lookup' => '1' , 'groups' => '1' , 'deskripsi' => '1' , 'catatan' => '1' , 'content' => '1' , 'status_download' => '1'
        ];
        $this->json('POST', '/daftarreferensi', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowDaftarReferensi()
    {
        $data = factory(DaftarReferensi::class)->create();
        $this->json('GET', '/daftarreferensi/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateDaftarReferensi()
    {
        $data = factory(DaftarReferensi::class)->create();
        $properties = [
                'id_lookup' => '1' , 'groups' => '1' , 'deskripsi' => '1' , 'catatan' => '1' , 'content' => '1' , 'status_download' => '1'
            ];
        $this->json('PATCH', '/daftarreferensi/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyDaftarReferensi()
    {
        $data = factory(DaftarReferensi::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/daftarreferensi', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
