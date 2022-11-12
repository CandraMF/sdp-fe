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
     *      @OA\Property(property="id_prasarana_lahan", type="integer"),
     *      @OA\Property(property="id_jenis_prasarana_lahan", type="string"),
     *      @OA\Property(property="nama_prasarana_lahan", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="tgl_pengadaan", type="date"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_prasarana_lahan
     * @property string id_jenis_prasarana_lahan
     * @property string nama_prasarana_lahan
     * @property string id_upt
     * @property date tgl_pengadaan
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class PrasaranaLahan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "prasarana_lahan";
    protected $primaryKey = "id_prasarana_lahan";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_jenis_prasarana_lahan' ,'nama_prasarana_lahan' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_prasarana_lahan;
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
