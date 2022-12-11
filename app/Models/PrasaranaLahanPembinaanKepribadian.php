<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PrasaranaLahanPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PrasaranaLahanPembinaanKepribadian"),
 *      description="PrasaranaLahanPembinaanKepribadian Model",
 *      type="object",
 *      title="PrasaranaLahanPembinaanKepribadian Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_prasarana_lahan", type="integer"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_prasarana_lahan
     * @property integer id_pembinaan_kepribadian
     * @property datetime updated_at
     * @property string updated_by
 */
class PrasaranaLahanPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "prasarana_lahan_pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_prasarana_lahan' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_prasarana_lahan' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_prasarana_lahan' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
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
