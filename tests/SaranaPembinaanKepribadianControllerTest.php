<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\SaranaPembinaanKepribadian;

class SaranaPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexSaranaPembinaanKepribadian()
    {
        $data = factory(SaranaPembinaanKepribadian::class)->create();
        $this->json('GET', '/saranapembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreSaranaPembinaanKepribadian()
    {
        $data = factory(SaranaPembinaanKepribadian::class)->create();
        $properties = [
                'id_sarana' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/saranapembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowSaranaPembinaanKepribadian()
    {
        $data = factory(SaranaPembinaanKepribadian::class)->create();
        $this->json('GET', '/saranapembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateSaranaPembinaanKepribadian()
    {
        $data = factory(SaranaPembinaanKepribadian::class)->create();
        $properties = [
                'id_sarana' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/saranapembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroySaranaPembinaanKepribadian()
    {
        $data = factory(SaranaPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/saranapembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
