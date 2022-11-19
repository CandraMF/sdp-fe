<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\Pegawai;

class PegawaiControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPegawai()
    {
        $data = factory(Pegawai::class)->create();
        $this->json('GET', '/pegawai', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStorePegawai()
    {
        $data = factory(Pegawai::class)->create();
        $properties = [
                'id_pegawai' => '1' , 'nip' => '1' , 'nama' => '1' , 'id_tempat_lahir' => '1' , 'tempat_lahir_lain' => '1' , 'tgl_lahir' => '1' , 'id_jenis_kelamin' => '1' , 'alamat' => '1' , 'jabatan' => '1' , 'pangkat' => '1' , 'golongan' => '1' , 'bagian' => '1' , 'email' => '1' , 'telepon' => '1' , 'foto' => '1' , 'id_upt' => '1' , 'konsolidasi' => '1' , 'is_active' => '1' , 'is_pk' => '1' , 'id_pengunjung_finger' => '1' , 'is_deleted' => '1' , 'created' => '1' , 'created_by' => '1' , 'updated' => '1' , 'updated_by' => '1'
        ];
        $this->json('POST', '/pegawai', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowPegawai()
    {
        $data = factory(Pegawai::class)->create();
        $this->json('GET', '/pegawai/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdatePegawai()
    {
        $data = factory(Pegawai::class)->create();
        $properties = [
                'id_pegawai' => '1' , 'nip' => '1' , 'nama' => '1' , 'id_tempat_lahir' => '1' , 'tempat_lahir_lain' => '1' , 'tgl_lahir' => '1' , 'id_jenis_kelamin' => '1' , 'alamat' => '1' , 'jabatan' => '1' , 'pangkat' => '1' , 'golongan' => '1' , 'bagian' => '1' , 'email' => '1' , 'telepon' => '1' , 'foto' => '1' , 'id_upt' => '1' , 'konsolidasi' => '1' , 'is_active' => '1' , 'is_pk' => '1' , 'id_pengunjung_finger' => '1' , 'is_deleted' => '1' , 'created' => '1' , 'created_by' => '1' , 'updated' => '1' , 'updated_by' => '1'
            ];
        $this->json('PATCH', '/pegawai/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyPegawai()
    {
        $data = factory(Pegawai::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/pegawai', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
