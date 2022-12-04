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
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="tanggal", type="date"),
     *      @OA\Property(property="jam_mulai", type="time"),
     *      @OA\Property(property="jam_selesai", type="time"),
     *      @OA\Property(property="id_instruktur", type="string"),
     *      @OA\Property(property="materi_pembinaan_kepribadian", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_pembinaan_kepribadian
     * @property date tanggal
     * @property time jam_mulai
     * @property time jam_selesai
     * @property string id_instruktur
     * @property string materi_pembinaan_kepribadian
     * @property string foto
     * @property string status
     * @property datetime updated_at
     * @property string updated_by
 */
class JadwalPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "jadwal_pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_pembinaan_kepribadian' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'updated_by'
    ];

    protected $orderable = [
        'id_pembinaan_kepribadian' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'updated_by'
    ];

    protected $searchable = [
        'id_pembinaan_kepribadian' ,'tanggal' ,'jam_mulai' ,'jam_selesai' ,'id_instruktur' ,'materi_pembinaan_kepribadian' ,'foto' ,'status' ,'updated_by'
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
}
