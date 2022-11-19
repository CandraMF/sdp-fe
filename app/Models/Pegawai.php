<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pegawai
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Pegawai"),
 *      description="Pegawai Model",
 *      type="object",
 *      title="Pegawai Model",
     *      @OA\Property(property="id_pegawai", type="string"),
     *      @OA\Property(property="nip", type="string"),
     *      @OA\Property(property="nama", type="string"),
     *      @OA\Property(property="id_tempat_lahir", type="string"),
     *      @OA\Property(property="tempat_lahir_lain", type="string"),
     *      @OA\Property(property="tgl_lahir", type="date"),
     *      @OA\Property(property="id_jenis_kelamin", type="string"),
     *      @OA\Property(property="alamat", type="text"),
     *      @OA\Property(property="jabatan", type="string"),
     *      @OA\Property(property="pangkat", type="string"),
     *      @OA\Property(property="golongan", type="string"),
     *      @OA\Property(property="bagian", type="string"),
     *      @OA\Property(property="email", type="string"),
     *      @OA\Property(property="telepon", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="konsolidasi", type="integer"),
     *      @OA\Property(property="is_active", type="boolean"),
     *      @OA\Property(property="is_pk", type="boolean"),
     *      @OA\Property(property="id_pengunjung_finger", type="string"),
     *      @OA\Property(property="is_deleted", type="boolean"),
     *      @OA\Property(property="created", type="datetime"),
     *      @OA\Property(property="created_by", type="string"),
     *      @OA\Property(property="updated", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property string id_pegawai
     * @property string nip
     * @property string nama
     * @property string id_tempat_lahir
     * @property string tempat_lahir_lain
     * @property date tgl_lahir
     * @property string id_jenis_kelamin
     * @property text alamat
     * @property string jabatan
     * @property string pangkat
     * @property string golongan
     * @property string bagian
     * @property string email
     * @property string telepon
     * @property string foto
     * @property string id_upt
     * @property integer konsolidasi
     * @property boolean is_active
     * @property boolean is_pk
     * @property string id_pengunjung_finger
     * @property boolean is_deleted
     * @property datetime created
     * @property string created_by
     * @property datetime updated
     * @property string updated_by
 */
class Pegawai extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "pegawai";
    protected $primaryKey = "id_pegawai";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'nip' ,'nama' ,'id_tempat_lahir' ,'tempat_lahir_lain' ,'tgl_lahir' ,'id_jenis_kelamin' ,'alamat' ,'jabatan' ,'pangkat' ,'golongan' ,'bagian' ,'email' ,'telepon' ,'foto' ,'id_upt' ,'konsolidasi' ,'is_active' ,'is_pk' ,'id_pengunjung_finger' ,'is_deleted' ,'created' ,'created_by' ,'updated' ,'updated_by'
    ];

    protected $orderable = [
        'nip' ,'nama' ,'id_tempat_lahir' ,'tempat_lahir_lain' ,'tgl_lahir' ,'id_jenis_kelamin' ,'alamat' ,'jabatan' ,'pangkat' ,'golongan' ,'bagian' ,'email' ,'telepon' ,'foto' ,'id_upt' ,'konsolidasi' ,'is_active' ,'is_pk' ,'id_pengunjung_finger' ,'is_deleted' ,'created' ,'created_by' ,'updated' ,'updated_by'
    ];

    protected $searchable = [
        'nip' ,'nama' ,'id_tempat_lahir' ,'tempat_lahir_lain' ,'tgl_lahir' ,'id_jenis_kelamin' ,'alamat' ,'jabatan' ,'pangkat' ,'golongan' ,'bagian' ,'email' ,'telepon' ,'foto' ,'id_upt' ,'konsolidasi' ,'is_active' ,'is_pk' ,'id_pengunjung_finger' ,'is_deleted' ,'created' ,'created_by' ,'updated' ,'updated_by'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_pegawai;
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
