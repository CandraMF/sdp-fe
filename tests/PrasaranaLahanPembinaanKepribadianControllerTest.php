<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PrasaranaLahanPembinaanKepribadian;

class PrasaranaLahanPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPrasaranaLahanPembinaanKepribadian()
    {
        $data = factory(PrasaranaLahanPembinaanKepribadian::class)->create();
        $this->json('GET', '/prasaranalahanpembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePrasaranaLahanPembinaanKepribadian()
    {
        $data = factory(PrasaranaLahanPembinaanKepribadian::class)->create();
        $properties = [
                'id_prasarana_lahan' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/prasaranalahanpembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPrasaranaLahanPembinaanKepribadian()
    {
        $data = factory(PrasaranaLahanPembinaanKepribadian::class)->create();
        $this->json('GET', '/prasaranalahanpembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePrasaranaLahanPembinaanKepribadian()
    {
        $data = factory(PrasaranaLahanPembinaanKepribadian::class)->create();
        $properties = [
                'id_prasarana_lahan' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/prasaranalahanpembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPrasaranaLahanPembinaanKepribadian()
    {
        $data = factory(PrasaranaLahanPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/prasaranalahanpembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
