<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PesertaPembinaanKepribadian;

/**
 * Class DaftarPesertaPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="DaftarPesertaPembinaanKepribadian"),
 *      description="DaftarPesertaPembinaanKepribadian Model",
 *      type="object",
 *      title="DaftarPesertaPembinaanKepribadian Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_jadwal_pk", type="integer"),
     *      @OA\Property(property="id_peserta", type="integer"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
     *      @OA\Property(property="verifikasi_oleh", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_jadwal_pk
     * @property integer id_peserta
     * @property string status
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
     * @property string verifikasi_oleh
 */
class DaftarPesertaPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "daftar_peserta_pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' , 'updated_at', 'updated_by' ,'verifikasi_oleh'
    ];

    protected $orderable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' , 'updated_at', 'updated_by' ,'verifikasi_oleh'
    ];

    protected $searchable = [
        'id_jadwal_pk' ,'id_peserta' ,'status' ,'keterangan' , 'updated_at', 'updated_by' ,'verifikasi_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id;
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

    public function peserta()
    {
        return $this->hasMany(PesertaPembinaanKepribadian::class, 'id_daftar_peserta_pembinaan_kepribadian', 'id');
    }
}
