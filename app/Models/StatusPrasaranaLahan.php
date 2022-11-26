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
 *      @OA\Property(property="id_status_prasarana_lahan", type="integer"),
 *      @OA\Property(property="id_prasarana_lahan", type="integer"),
 *      @OA\Property(property="tahun", type="integer"),
 *      @OA\Property(property="bulan", type="string"),
 *      @OA\Property(property="status", type="string"),
 *      @OA\Property(property="kepemilkan", type="string"),
 *      @OA\Property(property="luas_dipakai", type="decimal"),
 *      @OA\Property(property="lahan_tidur", type="decimal"),
 *      @OA\Property(property="satuan", type="string"),
 *      @OA\Property(property="foto", type="string"),
 *      @OA\Property(property="keterangan", type="string"),
 *      @OA\Property(property="update_terakhir", type="datetime"),
 *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
 * @property integer id_status_prasarana_lahan
 * @property integer id_prasarana_lahan
 * @property integer tahun
 * @property string bulan
 * @property string status
 * @property string kepemilkan
 * @property decimal luas_dipakai
 * @property decimal lahan_tidur
 * @property string satuan
 * @property string foto
 * @property string keterangan
 * @property datetime update_terakhir
 * @property string update_oleh
 */
class StatusPrasaranaLahan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "status_prasarana_lahan";
    protected $primaryKey = "id_status_prasarana_lahan";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_prasarana_lahan', 'tahun', 'bulan', 'status', 'kepemilkan', 'luas_dipakai', 'lahan_tidur', 'satuan', 'foto', 'keterangan', 'update_terakhir', 'update_oleh'
    ];

    protected $orderable = [
        'id_prasarana_lahan', 'tahun', 'bulan', 'status', 'kepemilkan', 'luas_dipakai', 'lahan_tidur', 'satuan', 'foto', 'keterangan', 'update_terakhir', 'update_oleh'
    ];

    protected $searchable = [
        'id_prasarana_lahan', 'tahun', 'bulan', 'status', 'kepemilkan', 'luas_dipakai', 'lahan_tidur', 'satuan', 'foto', 'keterangan', 'update_terakhir', 'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_status_prasarana_lahan;
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
