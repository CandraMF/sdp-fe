<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SaranaPelatihanKeterampilan
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="SaranaPelatihanKeterampilan"),
 *      description="SaranaPelatihanKeterampilan Model",
 *      type="object",
 *      title="SaranaPelatihanKeterampilan Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_sarana", type="integer"),
     *      @OA\Property(property="id_pelatihan_keterampilan", type="integer"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_sarana
     * @property integer id_pelatihan_keterampilan
     * @property datetime updated_at
     * @property string updated_by
 */
class SaranaPelatihanKeterampilan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "sarana_pelatihan_keterampilan";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_sarana' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_sarana' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_sarana' ,'id_pelatihan_keterampilan' , 'updated_at', 'updated_by'
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
