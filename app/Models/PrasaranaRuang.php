<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrasaranaRuang
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PrasaranaRuang"),
 *      description="PrasaranaRuang Model",
 *      type="object",
 *      title="PrasaranaRuang Model",
     *      @OA\Property(property="id_prasarana_ruang", type="integer"),
     *      @OA\Property(property="id_jenis_prasarana_ruang", type="string"),
     *      @OA\Property(property="nama_prasarana_ruang", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="tgl_pengadaan", type="date"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_prasarana_ruang
     * @property string id_jenis_prasarana_ruang
     * @property string nama_prasarana_ruang
     * @property string id_upt
     * @property date tgl_pengadaan
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class PrasaranaRuang extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "prasarana_ruang";
    protected $primaryKey = "id_prasarana_ruang";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_prasarana_ruang' ,'nama_prasarana_ruang' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_jenis_prasarana_ruang' ,'nama_prasarana_ruang' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_jenis_prasarana_ruang' ,'nama_prasarana_ruang' ,'id_upt' ,'tgl_pengadaan' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_prasarana_ruang;
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
