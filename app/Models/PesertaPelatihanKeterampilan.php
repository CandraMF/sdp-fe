<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PesertaPelatihanKeterampilan
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PesertaPelatihanKeterampilan"),
 *      description="PesertaPelatihanKeterampilan Model",
 *      type="object",
 *      title="PesertaPelatihanKeterampilan Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_daftar_peserta_pelatihan_keterampilan", type="integer"),
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
     * @property integer id_daftar_peserta_pelatihan_keterampilan
     * @property integer id_wbp
     * @property boolean kehadiran
     * @property string no_sertifikat
     * @property string file_sertifikat
     * @property decimal nilai
     * @property string predikat
     * @property datetime updated_at
     * @property string updated_by
 */
class PesertaPelatihanKeterampilan extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "peserta_pelatihan_keterampilan";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_daftar_peserta_pelatihan_keterampilan' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_daftar_peserta_pelatihan_keterampilan' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_daftar_peserta_pelatihan_keterampilan' ,'id_wbp' ,'kehadiran' ,'no_sertifikat' ,'file_sertifikat' ,'nilai' ,'predikat' , 'updated_at', 'updated_by'
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
