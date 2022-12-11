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
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_mitra", type="string"),
     *      @OA\Property(property="jenis_mitra", type="string"),
     *      @OA\Property(property="kontrak_dengan", type="string"),
     *      @OA\Property(property="id_kanwil", type="integer"),
     *      @OA\Property(property="id_upt", type="integer"),
     *      @OA\Property(property="nomor_kontrak", type="string"),
     *      @OA\Property(property="kontrak_awal", type="date"),
     *      @OA\Property(property="kontrak_akhir", type="date"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property string id_mitra
     * @property string jenis_mitra
     * @property string kontrak_dengan
     * @property integer id_kanwil
     * @property integer id_upt
     * @property string nomor_kontrak
     * @property date kontrak_awal
     * @property date kontrak_akhir
     * @property datetime updated_at
     * @property string updated_by
 */
class MitraKontrak extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "mitra_kontrak";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_mitra' ,'jenis_mitra' ,'kontrak_dengan' ,'id_kanwil' ,'id_upt' ,'nomor_kontrak' ,'kontrak_awal' ,'kontrak_akhir' , 'updated_at', 'updated_by'
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
