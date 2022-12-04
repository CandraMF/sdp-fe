<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StatusPrasaranaLahan
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="StatusPrasaranaLahan"),
 *      description="StatusPrasaranaLahan Model",
 *      type="object",
 *      title="StatusPrasaranaLahan Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_prasarana_lahan", type="integer"),
     *      @OA\Property(property="tanggal", type="date"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="kepemilikan", type="string"),
     *      @OA\Property(property="luas_dipakai", type="decimal"),
     *      @OA\Property(property="lahan_tidur", type="decimal"),
     *      @OA\Property(property="satuan", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_prasarana_lahan
     * @property date tanggal
     * @property string status
     * @property string kepemilikan
     * @property decimal luas_dipakai
     * @property decimal lahan_tidur
     * @property string satuan
     * @property string foto
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
 */
class StatusPrasaranaLahan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "status_prasarana_lahan";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_prasarana_lahan' ,'tanggal' ,'status' ,'kepemilikan' ,'luas_dipakai' ,'lahan_tidur' ,'satuan' ,'foto' ,'keterangan' ,'updated_by'
    ];

    protected $orderable = [
        'id_prasarana_lahan' ,'tanggal' ,'status' ,'kepemilikan' ,'luas_dipakai' ,'lahan_tidur' ,'satuan' ,'foto' ,'keterangan' ,'updated_by'
    ];

    protected $searchable = [
        'id_prasarana_lahan' ,'tanggal' ,'status' ,'kepemilikan' ,'luas_dipakai' ,'lahan_tidur' ,'satuan' ,'foto' ,'keterangan' ,'updated_by'
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
