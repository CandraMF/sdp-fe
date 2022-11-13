<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LaporanPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="LaporanPembinaanKepribadian"),
 *      description="LaporanPembinaanKepribadian Model",
 *      type="object",
 *      title="LaporanPembinaanKepribadian Model",
     *      @OA\Property(property="id_laporan_pk", type="integer"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="bulan", type="string"),
     *      @OA\Property(property="tahun", type="integer"),
     *      @OA\Property(property="jumlah_hari", type="decimal"),
     *      @OA\Property(property="jumlah_pembinaan_kepribadian", type="decimal"),
     *      @OA\Property(property="jumlah_peserta", type="decimal"),
     *      @OA\Property(property="jumlah_instruktur_petugas", type="decimal"),
     *      @OA\Property(property="jumlah_instruktur_napi", type="decimal"),
     *      @OA\Property(property="jumlah_instruktur_instansi_lain", type="decimal"),
     *      @OA\Property(property="jumlah_instruktur_mitra", type="decimal"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="verifikasi_upt", type="string"),
     *      @OA\Property(property="verifikasi_kanwil", type="string"),
     *      @OA\Property(property="verifikasi_ditjen", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_laporan_pk
     * @property integer id_pembinaan_kepribadian
     * @property string id_upt
     * @property string bulan
     * @property integer tahun
     * @property decimal jumlah_hari
     * @property decimal jumlah_pembinaan_kepribadian
     * @property decimal jumlah_peserta
     * @property decimal jumlah_instruktur_petugas
     * @property decimal jumlah_instruktur_napi
     * @property decimal jumlah_instruktur_instansi_lain
     * @property decimal jumlah_instruktur_mitra
     * @property string keterangan
     * @property string status
     * @property string verifikasi_upt
     * @property string verifikasi_kanwil
     * @property string verifikasi_ditjen
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class LaporanPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "laporan_pembinaan_kepribadian";
    protected $primaryKey = "id_laporan_pk";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_pembinaan_kepribadian' ,'id_upt' ,'bulan' ,'tahun' ,'jumlah_hari' ,'jumlah_pembinaan_kepribadian' ,'jumlah_peserta' ,'jumlah_instruktur_petugas' ,'jumlah_instruktur_napi' ,'jumlah_instruktur_instansi_lain' ,'jumlah_instruktur_mitra' ,'keterangan' ,'status' ,'verifikasi_upt' ,'verifikasi_kanwil' ,'verifikasi_ditjen' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_pembinaan_kepribadian' ,'id_upt' ,'bulan' ,'tahun' ,'jumlah_hari' ,'jumlah_pembinaan_kepribadian' ,'jumlah_peserta' ,'jumlah_instruktur_petugas' ,'jumlah_instruktur_napi' ,'jumlah_instruktur_instansi_lain' ,'jumlah_instruktur_mitra' ,'keterangan' ,'status' ,'verifikasi_upt' ,'verifikasi_kanwil' ,'verifikasi_ditjen' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_pembinaan_kepribadian' ,'id_upt' ,'bulan' ,'tahun' ,'jumlah_hari' ,'jumlah_pembinaan_kepribadian' ,'jumlah_peserta' ,'jumlah_instruktur_petugas' ,'jumlah_instruktur_napi' ,'jumlah_instruktur_instansi_lain' ,'jumlah_instruktur_mitra' ,'keterangan' ,'status' ,'verifikasi_upt' ,'verifikasi_kanwil' ,'verifikasi_ditjen' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_laporan_pk;
    }

    /**
     * get primary key name
     *
     * @var string
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }
}
