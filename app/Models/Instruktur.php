<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Instruktur
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Instruktur"),
 *      description="Instruktur Model",
 *      type="object",
 *      title="Instruktur Model",
 *      @OA\Property(property="id", type="bigint"),
 *      @OA\Property(property="jenis_pembinaan_kepribadian", type="string"),
 *      @OA\Property(property="jenis_instruktur", type="string"),
 *      @OA\Property(property="id_napi", type="string"),
 *      @OA\Property(property="id_petugas", type="string"),
 *      @OA\Property(property="id_mitra", type="integer"),
 *      @OA\Property(property="nama_instruktur", type="string"),
 *      @OA\Property(property="asal_institusi_instruktur", type="string"),
 *      @OA\Property(property="no_telp", type="string"),
 *      @OA\Property(property="email", type="string"),
 *      @OA\Property(property="keterangan", type="string"),
 *      @OA\Property(property="updated_at", type="datetime"),
 *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
 * @property bigint id
 * @property string jenis_pembinaan_kepribadian
 * @property string jenis_instruktur
 * @property string id_napi
 * @property string id_petugas
 * @property integer id_mitra
 * @property string nama_instruktur
 * @property string asal_institusi_instruktur
 * @property string no_telp
 * @property string email
 * @property string keterangan
 * @property datetime updated_at
 * @property string updated_by
 */
class Instruktur extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "instruktur";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'jenis_pembinaan_kepribadian', 'jenis_instruktur', 'id_napi', 'id_petugas', 'id_mitra', 'nama_instruktur', 'asal_institusi_instruktur', 'no_telp', 'email', 'keterangan', 'updated_by'
    ];

    protected $orderable = [
        'jenis_pembinaan_kepribadian', 'jenis_instruktur', 'id_napi', 'id_petugas', 'id_mitra', 'nama_instruktur', 'asal_institusi_instruktur', 'no_telp', 'email', 'keterangan', 'updated_by'
    ];

    protected $searchable = [
        'jenis_pembinaan_kepribadian', 'jenis_instruktur', 'id_napi', 'id_petugas', 'id_mitra', 'nama_instruktur', 'asal_institusi_instruktur', 'no_telp', 'email', 'keterangan', 'updated_by'
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
