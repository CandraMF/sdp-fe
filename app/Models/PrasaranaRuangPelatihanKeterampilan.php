<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrasaranaRuangPelatihanKeterampilan
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PrasaranaRuangPelatihanKeterampilan"),
 *      description="PrasaranaRuangPelatihanKeterampilan Model",
 *      type="object",
 *      title="PrasaranaRuangPelatihanKeterampilan Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_prasarana_ruang", type="integer"),
     *      @OA\Property(property="id_pelatihan_keterampilan", type="integer"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_prasarana_ruang
     * @property integer id_pelatihan_keterampilan
     * @property datetime updated_at
     * @property string updated_by
 */
class PrasaranaRuangPelatihanKeterampilan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "prasarana_ruang_pelatihan_keterampilan";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_prasarana_ruang' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_prasarana_ruang' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_prasarana_ruang' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
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