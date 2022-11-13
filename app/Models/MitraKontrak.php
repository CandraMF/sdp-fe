<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MitraKontrak
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="MitraKontrak"),
 *      description="MitraKontrak Model",
 *      type="object",
 *      title="MitraKontrak Model",
     *      @OA\Property(property="id_kontrak", type="integer"),
     *      @OA\Property(property="id_mitra", type="string"),
     *      @OA\Property(property="jenis_mitra", type="string"),
     *      @OA\Property(property="kontrak_dengan", type="string"),
     *      @OA\Property(property="id_kanwil", type="integer"),
     *      @OA\Property(property="id_upt", type="integer"),
     *      @OA\Property(property="nomor_kontrak", type="string"),
     *      @OA\Property(property="kontrak_awal", type="date"),
     *      @OA\Property(property="kontrak_akhir", type="date"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_kontrak
     * @property string id_mitra
     * @property string jenis_mitra
     * @property string kontrak_dengan
     * @property integer id_kanwil
     * @property integer id_upt
     * @property string nomor_kontrak
     * @property date kontrak_awal
     * @property date kontrak_akhir
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class MitraKontrak extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "mitra_kontrak";
    protected $primaryKey = "id_kontrak";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_kontrak;
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
