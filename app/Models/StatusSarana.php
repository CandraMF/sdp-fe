<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StatusSarana
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="StatusSarana"),
 *      description="StatusSarana Model",
 *      type="object",
 *      title="StatusSarana Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_sarana", type="integer"),
     *      @OA\Property(property="tanggal", type="date"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="kepemilikan", type="string"),
     *      @OA\Property(property="jumlah", type="integer"),
     *      @OA\Property(property="satuan", type="string"),
     *      @OA\Property(property="kondisi_baik", type="integer"),
     *      @OA\Property(property="kondisi_rusak", type="integer"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_sarana
     * @property date tanggal
     * @property string status
     * @property string kepemilikan
     * @property integer jumlah
     * @property string satuan
     * @property integer kondisi_baik
     * @property integer kondisi_rusak
     * @property string foto
     * @property string keterangan
     * @property datetime updated_at
     * @property string updated_by
 */
class StatusSarana extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "status_sarana";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_sarana' ,'tanggal' ,'status' ,'kepemilikan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_sarana' ,'tanggal' ,'status' ,'kepemilikan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_sarana' ,'tanggal' ,'status' ,'kepemilikan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' , 'updated_at', 'updated_by'
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
