<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DaftarPesertaPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="DaftarPesertaPembinaanKepribadian"),
 *      description="DaftarPesertaPembinaanKepribadian Model",
 *      type="object",
 *      title="DaftarPesertaPembinaanKepribadian Model",
     *      @OA\Property(property="id_daftar_ppk", type="integer"),
     *      @OA\Property(property="id_jadwal_pk", type="integer"),
     *      @OA\Property(property="id_peserta", type="integer"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
     *      @OA\Property(property="verifikasi_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_daftar_ppk
     * @property integer id_jadwal_pk
     * @property integer id_peserta
     * @property string status
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
     * @property string verifikasi_oleh
 */
class DaftarPesertaPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "daftar_peserta_pembinaan_kepribadian";
    protected $primaryKey = "id_daftar_ppk";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' ,'update_terakhir' ,'update_oleh' ,'verifikasi_oleh'
    ];

    protected $orderable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' ,'update_terakhir' ,'update_oleh' ,'verifikasi_oleh'
    ];

    protected $searchable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' ,'update_terakhir' ,'update_oleh' ,'verifikasi_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_daftar_ppk;
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
