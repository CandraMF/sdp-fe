<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StatusPrasaranaRuang
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="StatusPrasaranaRuang"),
 *      description="StatusPrasaranaRuang Model",
 *      type="object",
 *      title="StatusPrasaranaRuang Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_prasarana_ruang", type="integer"),
     *      @OA\Property(property="tanggal", type="date"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="kepemilikan", type="string"),
     *      @OA\Property(property="luas", type="decimal"),
     *      @OA\Property(property="satuan_luas", type="string"),
     *      @OA\Property(property="jumlah_lantai", type="decimal"),
     *      @OA\Property(property="jumlah_ruang", type="decimal"),
     *      @OA\Property(property="kondisi_baik", type="decimal"),
     *      @OA\Property(property="kondisi_rusak", type="decimal"),
     *      @OA\Property(property="satuan_kondisi", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="pendaftaran_disnaker", type="string"),
     *      @OA\Property(property="catatan_disnaker", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_prasarana_ruang
     * @property date tanggal
     * @property string status
     * @property string kepemilikan
     * @property decimal luas
     * @property string satuan_luas
     * @property decimal jumlah_lantai
     * @property decimal jumlah_ruang
     * @property decimal kondisi_baik
     * @property decimal kondisi_rusak
     * @property string satuan_kondisi
     * @property string foto
     * @property string pendaftaran_disnaker
     * @property string catatan_disnaker
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
 */
class StatusPrasaranaRuang extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "status_prasarana_ruang";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_prasarana_ruang' ,'tanggal' ,'status' ,'kepemilikan' ,'luas' ,'satuan_luas' ,'jumlah_lantai' ,'jumlah_ruang' ,'kondisi_baik' ,'kondisi_rusak' ,'satuan_kondisi' ,'foto' ,'pendaftaran_disnaker' ,'catatan_disnaker' ,'keterangan' ,'updated_by'
    ];

    protected $orderable = [
        'id_prasarana_ruang' ,'tanggal' ,'status' ,'kepemilikan' ,'luas' ,'satuan_luas' ,'jumlah_lantai' ,'jumlah_ruang' ,'kondisi_baik' ,'kondisi_rusak' ,'satuan_kondisi' ,'foto' ,'pendaftaran_disnaker' ,'catatan_disnaker' ,'keterangan' ,'updated_by'
    ];

    protected $searchable = [
        'id_prasarana_ruang' ,'tanggal' ,'status' ,'kepemilikan' ,'luas' ,'satuan_luas' ,'jumlah_lantai' ,'jumlah_ruang' ,'kondisi_baik' ,'kondisi_rusak' ,'satuan_kondisi' ,'foto' ,'pendaftaran_disnaker' ,'catatan_disnaker' ,'keterangan' ,'updated_by'
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
