<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\StatusPrasaranaRuang;

class StatusPrasaranaRuangControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexStatusPrasaranaRuang()
    {
        $data = factory(StatusPrasaranaRuang::class)->create();
        $this->json('GET', '/statusprasaranaruang', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreStatusPrasaranaRuang()
    {
        $data = factory(StatusPrasaranaRuang::class)->create();
        $properties = [
                'id_status_prasarana_ruang' => '1' , 'id_prasarana_ruang' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'luas' => '1' , 'satuan_luas' => '1' , 'jumlah_lantai' => '1' , 'jumlah_ruang' => '1' , 'kondisi_baik' => '1' , 'kondisi_rusak' => '1' , 'satuan_kondisi' => '1' , 'foto' => '1' , 'pendaftaran_disnaker' => '1' , 'catatan_disnaker' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/statusprasaranaruang', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowStatusPrasaranaRuang()
    {
        $data = factory(StatusPrasaranaRuang::class)->create();
        $this->json('GET', '/statusprasaranaruang/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateStatusPrasaranaRuang()
    {
        $data = factory(StatusPrasaranaRuang::class)->create();
        $properties = [
                'id_status_prasarana_ruang' => '1' , 'id_prasarana_ruang' => '1' , 'tahun' => '1' , 'bulan' => '1' , 'status' => '1' , 'kepemilkan' => '1' , 'luas' => '1' , 'satuan_luas' => '1' , 'jumlah_lantai' => '1' , 'jumlah_ruang' => '1' , 'kondisi_baik' => '1' , 'kondisi_rusak' => '1' , 'satuan_kondisi' => '1' , 'foto' => '1' , 'pendaftaran_disnaker' => '1' , 'catatan_disnaker' => '1' , 'keterangan' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/statusprasaranaruang/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyStatusPrasaranaRuang()
    {
        $data = factory(StatusPrasaranaRuang::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/statusprasaranaruang', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
