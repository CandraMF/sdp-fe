<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrasaranaLahan
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PrasaranaLahan"),
 *      description="PrasaranaLahan Model",
 *      type="object",
 *      title="PrasaranaLahan Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_jenis_prasarana_lahan", type="string"),
     *      @OA\Property(property="nama_prasarana_lahan", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="tgl_pengadaan", type="date"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property string id_jenis_prasarana_lahan
     * @property string nama_prasarana_lahan
     * @property string id_upt
     * @property date tgl_pengadaan
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
 */
class PrasaranaLahan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "prasarana_lahan";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' , 'updated_at', 'updated_by'
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
