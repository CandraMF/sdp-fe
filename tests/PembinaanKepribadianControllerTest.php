<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\PembinaanKepribadian;

class PembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPembinaanKepribadian()
    {
        $data = factory(PembinaanKepribadian::class)->create();
        $this->json('GET', '/pembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePembinaanKepribadian()
    {
        $data = factory(PembinaanKepribadian::class)->create();
        $properties = [
                'id_jenis_pembinaan_kepribadian' => '1' , 'id_upt' => '1' , 'id_mitra' => '1' , 'nama_program' => '1' , 'program_wajib' => '1' , 'materi_pembinaan_kepribadian' => '1' , 'id_instruktur' => '1' , 'penangung_jawab' => '1' , 'tanggal_mulai' => '1' , 'tanggal_selesai' => '1' , 'tempat_pelaksanaan' => '1' , 'perlu_kelulusan' => '1' , 'id_sarana' => '1' , 'id_prasarana' => '1' , 'realisasi_anggaran' => '1' , 'id_jenis_anggaran' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'status' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/pembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPembinaanKepribadian()
    {
        $data = factory(PembinaanKepribadian::class)->create();
        $this->json('GET', '/pembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePembinaanKepribadian()
    {
        $data = factory(PembinaanKepribadian::class)->create();
        $properties = [
                'id_jenis_pembinaan_kepribadian' => '1' , 'id_upt' => '1' , 'id_mitra' => '1' , 'nama_program' => '1' , 'program_wajib' => '1' , 'materi_pembinaan_kepribadian' => '1' , 'id_instruktur' => '1' , 'penangung_jawab' => '1' , 'tanggal_mulai' => '1' , 'tanggal_selesai' => '1' , 'tempat_pelaksanaan' => '1' , 'perlu_kelulusan' => '1' , 'id_sarana' => '1' , 'id_prasarana' => '1' , 'realisasi_anggaran' => '1' , 'id_jenis_anggaran' => '1' , 'foto' => '1' , 'keterangan' => '1' , 'status' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/pembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPembinaanKepribadian()
    {
        $data = factory(PembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/pembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
