<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PesertaPembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PesertaPembinaanKepribadian"),
 *      description="PesertaPembinaanKepribadian Model",
 *      type="object",
 *      title="PesertaPembinaanKepribadian Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_daftar_peserta_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="id_wbp", type="integer"),
     *      @OA\Property(property="kehadiran", type="boolean"),
     *      @OA\Property(property="no_sertifikat", type="string"),
     *      @OA\Property(property="file_sertifikat", type="string"),
     *      @OA\Property(property="nilai", type="decimal"),
     *      @OA\Property(property="predikat", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property integer id_daftar_peserta_pembinaan_kepribadian
     * @property integer id_wbp
     * @property boolean kehadiran
     * @property string no_sertifikat
     * @property string file_sertifikat
     * @property decimal nilai
     * @property string predikat
     * @property datetime updated_at
     * @property string updated_by
 */
class PesertaPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "peserta_pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_daftar_peserta_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'updated_by'
    ];

    protected $orderable = [
        'id_daftar_peserta_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'updated_by'
    ];

    protected $searchable = [
        'id_daftar_peserta_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'updated_by'
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
