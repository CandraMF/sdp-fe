<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sarana
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Sarana"),
 *      description="Sarana Model",
 *      type="object",
 *      title="Sarana Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_jenis_sarana", type="string"),
     *      @OA\Property(property="nama_sarana", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="tgl_pengadaan", type="date"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property string id_jenis_sarana
     * @property string nama_sarana
     * @property string id_upt
     * @property date tgl_pengadaan
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
 */
class Sarana extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "sarana";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'updated_by'
    ];

    protected $orderable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'updated_by'
    ];

    protected $searchable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'updated_by'
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
