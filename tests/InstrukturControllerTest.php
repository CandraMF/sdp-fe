<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Instruktur;

class InstrukturControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexInstruktur()
    {
        $data = factory(Instruktur::class)->create();
        $this->json('GET', '/instruktur', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreInstruktur()
    {
        $data = factory(Instruktur::class)->create();
        $properties = [
                'id_pembinaan_kepribadian' => '1' , 'jenis_instruktur' => '1' , 'id_napi' => '1' , 'id_petugas' => '1' , 'id_mitra' => '1' , 'nama_instruktur' => '1' , 'asal_institusi_instruktur' => '1' , 'no_telp' => '1' , 'email' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/instruktur', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowInstruktur()
    {
        $data = factory(Instruktur::class)->create();
        $this->json('GET', '/instruktur/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateInstruktur()
    {
        $data = factory(Instruktur::class)->create();
        $properties = [
                'id_pembinaan_kepribadian' => '1' , 'jenis_instruktur' => '1' , 'id_napi' => '1' , 'id_petugas' => '1' , 'id_mitra' => '1' , 'nama_instruktur' => '1' , 'asal_institusi_instruktur' => '1' , 'no_telp' => '1' , 'email' => '1' , 'keterangan' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/instruktur/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyInstruktur()
    {
        $data = factory(Instruktur::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/instruktur', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
