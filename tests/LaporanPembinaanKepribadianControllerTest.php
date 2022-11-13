<?php

use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert as PHPUnit;
use Mockery as m;
use App\Models\LaporanPembinaanKepribadian;

class LaporanPembinaanKepribadianControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexLaporanPembinaanKepribadian()
    {
        $data = factory(LaporanPembinaanKepribadian::class)->create();
        $this->json('GET', '/laporanpembinaankepribadian', [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testStoreLaporanPembinaanKepribadian()
    {
        $data = factory(LaporanPembinaanKepribadian::class)->create();
        $properties = [
                'id_laporan_pk' => '1' , 'id_pembinaan_kepribadian' => '1' , 'id_upt' => '1' , 'bulan' => '1' , 'tahun' => '1' , 'jumlah_hari' => '1' , 'jumlah_pembinaan_kepribadian' => '1' , 'jumlah_peserta' => '1' , 'jumlah_instruktur_petugas' => '1' , 'jumlah_instruktur_napi' => '1' , 'jumlah_instruktur_instansi_lain' => '1' , 'jumlah_instruktur_mitra' => '1' , 'keterangan' => '1' , 'status' => '1' , 'verifikasi_upt' => '1' , 'verifikasi_kanwil' => '1' , 'verifikasi_ditjen' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
        ];
        $this->json('POST', '/laporanpembinaankepribadian', $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testShowLaporanPembinaanKepribadian()
    {
        $data = factory(LaporanPembinaanKepribadian::class)->create();
        $this->json('GET', '/laporanpembinaankepribadian/'.$data->id, [] , $this->postHeaders);
        $this->seeStatusCode(200);
    }

    public function testUpdateLaporanPembinaanKepribadian()
    {
        $data = factory(LaporanPembinaanKepribadian::class)->create();
        $properties = [
                'id_laporan_pk' => '1' , 'id_pembinaan_kepribadian' => '1' , 'id_upt' => '1' , 'bulan' => '1' , 'tahun' => '1' , 'jumlah_hari' => '1' , 'jumlah_pembinaan_kepribadian' => '1' , 'jumlah_peserta' => '1' , 'jumlah_instruktur_petugas' => '1' , 'jumlah_instruktur_napi' => '1' , 'jumlah_instruktur_instansi_lain' => '1' , 'jumlah_instruktur_mitra' => '1' , 'keterangan' => '1' , 'status' => '1' , 'verifikasi_upt' => '1' , 'verifikasi_kanwil' => '1' , 'verifikasi_ditjen' => '1' , 'update_terakhir' => '1' , 'update_oleh' => '1'
            ];
        $this->json('PATCH', '/laporanpembinaankepribadian/'.$data->id, $this->setupPayloads($properties) , $this->postHeaders);
        $this->seeStatusCode(200);
    }


    public function testDestroyLaporanPembinaanKepribadian()
    {
        $data = factory(LaporanPembinaanKepribadian::class)->create();
        $properties = [
            "id" => $data->id,
        ];
        $this->json('DELETE', '/laporanpembinaankepribadian', $this->setupDeletePayloads($data) , $this->postHeaders);
        $this->seeStatusCode(200);
    }

}
