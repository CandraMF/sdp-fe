<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PesertaPembinaanKepribadian;

class PesertaPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPesertaPembinaanKepribadian()
    {
        $data = factory(PesertaPembinaanKepribadian::class)->create();
        $this->json('GET', '/pesertapembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePesertaPembinaanKepribadian()
    {
        $data = factory(PesertaPembinaanKepribadian::class)->create();
        $properties = [
                'id_peserta_pk' => '1' , 'id_daftar_pembinaan_kepribadian' => '1' , 'id_wbp' => '1' , 'kehadiran' => '1' , 'no_sertifikat' => '1' , 'file_sertifikat' => '1' , 'nilai' => '1' , 'predikat' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/pesertapembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPesertaPembinaanKepribadian()
    {
        $data = factory(PesertaPembinaanKepribadian::class)->create();
        $this->json('GET', '/pesertapembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePesertaPembinaanKepribadian()
    {
        $data = factory(PesertaPembinaanKepribadian::class)->create();
        $properties = [
                'id_peserta_pk' => '1' , 'id_daftar_pembinaan_kepribadian' => '1' , 'id_wbp' => '1' , 'kehadiran' => '1' , 'no_sertifikat' => '1' , 'file_sertifikat' => '1' , 'nilai' => '1' , 'predikat' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/pesertapembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPesertaPembinaanKepribadian()
    {
        $data = factory(PesertaPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/pesertapembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
