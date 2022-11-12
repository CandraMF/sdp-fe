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
     *      @OA\Property(property="id_instruktur", type="integer"),
     *      @OA\Property(property="id_pembinaan_kepribadian", type="integer"),
     *      @OA\Property(property="jenis_instruktur", type="string"),
     *      @OA\Property(property="id_napi", type="string"),
     *      @OA\Property(property="id_petugas", type="string"),
     *      @OA\Property(property="id_mitra", type="integer"),
     *      @OA\Property(property="nama_instruktur", type="string"),
     *      @OA\Property(property="asal_institusi_instruktur", type="string"),
     *      @OA\Property(property="no_telp", type="string"),
     *      @OA\Property(property="email", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_instruktur
     * @property integer id_pembinaan_kepribadian
     * @property string jenis_instruktur
     * @property string id_napi
     * @property string id_petugas
     * @property integer id_mitra
     * @property string nama_instruktur
     * @property string asal_institusi_instruktur
     * @property string no_telp
     * @property string email
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class Instruktur extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "instruktur";
    protected $primaryKey = "id_instruktur";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_pembinaan_kepribadian' ,'jenis_instruktur' ,'id_napi' ,'id_petugas' ,'id_mitra' ,'nama_instruktur' ,'asal_institusi_instruktur' ,'no_telp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'id_pembinaan_kepribadian' ,'jenis_instruktur' ,'id_napi' ,'id_petugas' ,'id_mitra' ,'nama_instruktur' ,'asal_institusi_instruktur' ,'no_telp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'id_pembinaan_kepribadian' ,'jenis_instruktur' ,'id_napi' ,'id_petugas' ,'id_mitra' ,'nama_instruktur' ,'asal_institusi_instruktur' ,'no_telp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_instruktur;
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
