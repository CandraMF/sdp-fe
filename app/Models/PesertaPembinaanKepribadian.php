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
     *      @OA\Property(property="id_peserta_pk", type="integer"),
     *      @OA\Property(property="id_daftar_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="id_wbp", type="integer"),
     *      @OA\Property(property="kehadiran", type="boolean"),
     *      @OA\Property(property="no_sertifikat", type="string"),
     *      @OA\Property(property="file_sertifikat", type="string"),
     *      @OA\Property(property="nilai", type="decimal"),
     *      @OA\Property(property="predikat", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_peserta_pk
     * @property integer id_daftar_pembinaan_kepribadian
     * @property integer id_wbp
     * @property boolean kehadiran
     * @property string no_sertifikat
     * @property string file_sertifikat
     * @property decimal nilai
     * @property string predikat
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class PesertaPembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "peserta_pembinaan_kepribadian";
    protected $primaryKey = "id_peserta_pk";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_daftar_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_daftar_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_daftar_pembinaan_kepribadian' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_peserta_pk;
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
