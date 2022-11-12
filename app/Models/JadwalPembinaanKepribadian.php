<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JadwalPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="JadwalPembinaanKepribadian"),
 *      description="JadwalPembinaanKepribadian Model",
 *      type="object",
 *      title="JadwalPembinaanKepribadian Model",
     *      @OA\Property(property="id_jadwal_pk", type="integer"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="hari", type="string"),
     *      @OA\Property(property="tanggal", type="date"),
     *      @OA\Property(property="jam_mulai", type="time"),
     *      @OA\Property(property="jam_selesai", type="time"),
     *      @OA\Property(property="id_instruktur", type="string"),
     *      @OA\Property(property="materi_pembinaan_kepribadian", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_jadwal_pk
     * @property integer id_pembinaan_kepribadian
     * @property string hari
     * @property date tanggal
     * @property time jam_mulai
     * @property time jam_selesai
     * @property string id_instruktur
     * @property string materi_pembinaan_kepribadian
     * @property string foto
     * @property string status
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class JadwalPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "jadwal_pembinaan_kepribadian";
    protected $primaryKey = "id_jadwal_pk";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_pembinaan_kepribadian' ,'hari' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_pembinaan_kepribadian' ,'hari' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_pembinaan_kepribadian' ,'hari' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_jadwal_pk;
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
