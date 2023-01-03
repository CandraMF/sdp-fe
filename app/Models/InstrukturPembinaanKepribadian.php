<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Instruktur;

/**
 * Class InstrukturPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="InstrukturPembinaanKepribadian"),
 *      description="InstrukturPembinaanKepribadian Model",
 *      type="object",
 *      title="InstrukturPembinaanKepribadian Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_instruktur", type="integer"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_instruktur
     * @property integer id_pembinaan_kepribadian
     * @property datetime updated_at
     * @property string updated_by
 */
class InstrukturPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "instruktur_pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_instruktur' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_instruktur' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_instruktur' ,'id_pembinaan_kepribadian' , 'updated_at', 'updated_by'
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

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'id_instruktur', 'id');
    }
}
