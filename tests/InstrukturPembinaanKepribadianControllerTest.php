<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\InstrukturPembinaanKepribadian;

class InstrukturPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexInstrukturPembinaanKepribadian()
    {
        $data = factory(InstrukturPembinaanKepribadian::class)->create();
        $this->json('GET', '/instrukturpembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreInstrukturPembinaanKepribadian()
    {
        $data = factory(InstrukturPembinaanKepribadian::class)->create();
        $properties = [
                'id_instruktur' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/instrukturpembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowInstrukturPembinaanKepribadian()
    {
        $data = factory(InstrukturPembinaanKepribadian::class)->create();
        $this->json('GET', '/instrukturpembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateInstrukturPembinaanKepribadian()
    {
        $data = factory(InstrukturPembinaanKepribadian::class)->create();
        $properties = [
                'id_instruktur' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/instrukturpembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyInstrukturPembinaanKepribadian()
    {
        $data = factory(InstrukturPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/instrukturpembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
