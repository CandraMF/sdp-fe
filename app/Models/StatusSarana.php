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
     *      @OA\Property(property="id_status_sarana", type="integer"),
     *      @OA\Property(property="id_sarana", type="integer"),
     *      @OA\Property(property="tahun", type="integer"),
     *      @OA\Property(property="bulan", type="string"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="kepemilkan", type="string"),
     *      @OA\Property(property="jumlah", type="integer"),
     *      @OA\Property(property="satuan", type="string"),
     *      @OA\Property(property="kondisi_baik", type="integer"),
     *      @OA\Property(property="kondisi_rusak", type="integer"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_status_sarana
     * @property integer id_sarana
     * @property integer tahun
     * @property string bulan
     * @property string status
     * @property string kepemilkan
     * @property integer jumlah
     * @property string satuan
     * @property integer kondisi_baik
     * @property integer kondisi_rusak
     * @property string foto
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class StatusSarana extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "status_sarana";
    protected $primaryKey = "id_status_sarana";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_sarana' ,'tahun' ,'bulan' ,'status' ,'kepemilkan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_sarana' ,'tahun' ,'bulan' ,'status' ,'kepemilkan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_sarana' ,'tahun' ,'bulan' ,'status' ,'kepemilkan' ,'jumlah' ,'satuan' ,'kondisi_baik' ,'kondisi_rusak' ,'foto' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_status_sarana;
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
