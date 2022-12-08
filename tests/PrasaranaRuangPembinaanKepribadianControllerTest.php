<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PrasaranaRuangPembinaanKepribadian;

class PrasaranaRuangPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPrasaranaRuangPembinaanKepribadian()
    {
        $data = factory(PrasaranaRuangPembinaanKepribadian::class)->create();
        $this->json('GET', '/prasaranaruangpembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePrasaranaRuangPembinaanKepribadian()
    {
        $data = factory(PrasaranaRuangPembinaanKepribadian::class)->create();
        $properties = [
                'id_prasarana_ruang' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/prasaranaruangpembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPrasaranaRuangPembinaanKepribadian()
    {
        $data = factory(PrasaranaRuangPembinaanKepribadian::class)->create();
        $this->json('GET', '/prasaranaruangpembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePrasaranaRuangPembinaanKepribadian()
    {
        $data = factory(PrasaranaRuangPembinaanKepribadian::class)->create();
        $properties = [
                'id_prasarana_ruang' => '1' , 'id_pembinaan_kepribadian' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/prasaranaruangpembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPrasaranaRuangPembinaanKepribadian()
    {
        $data = factory(PrasaranaRuangPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/prasaranaruangpembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
