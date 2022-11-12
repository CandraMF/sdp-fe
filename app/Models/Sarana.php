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
     *      @OA\Property(property="id_sarana", type="integer"),
     *      @OA\Property(property="id_jenis_sarana", type="string"),
     *      @OA\Property(property="nama_sarana", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="tgl_pengadaan", type="date"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_sarana
     * @property string id_jenis_sarana
     * @property string nama_sarana
     * @property string id_upt
     * @property date tgl_pengadaan
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class Sarana extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "sarana";
    protected $primaryKey = "id_sarana";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_jenis_sarana' ,'nama_sarana' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_sarana;
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
