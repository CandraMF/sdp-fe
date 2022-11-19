<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Upt
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Upt"),
 *      description="Upt Model",
 *      type="object",
 *      title="Upt Model",
     *      @OA\Property(property="id_upt", type="bigint"),
     *      @OA\Property(property="uraian", type="string"),
     *      @OA\Property(property="kanwil", type="integer"),
     *      @OA\Property(property="jenis", type="string"),
     *      @OA\Property(property="kelas", type="string"),
     *      @OA\Property(property="kapasitas", type="integer"),
     *      @OA\Property(property="alamat", type="string"),
     *      @OA\Property(property="telpon", type="string"),
     *      @OA\Property(property="fax", type="string"),
     *      @OA\Property(property="kepala_upt", type="string"),
     *      @OA\Property(property="jabatan_ku", type="string"),
     *      @OA\Property(property="pangkat_ku", type="string"),
     *      @OA\Property(property="nip_ku", type="string"),
     *      @OA\Property(property="pejabat_upt", type="string"),
     *      @OA\Property(property="jabatan_pu", type="string"),
     *      @OA\Property(property="pangkat_pu", type="string"),
     *      @OA\Property(property="nip_pu", type="string"),
     *      @OA\Property(property="histori_remisi_tertentu", type="text"),
     *      @OA\Property(property="dati2", type="string"),
     *      @OA\Property(property="regf_month", type="boolean"),
     *      @OA\Property(property="kapasitas_kunjungan", type="integer"),
     *      @OA\Property(property="limit_kunjungan", type="integer"),
     *      @OA\Property(property="tahun_remisi", type="integer"),
     *      @OA\Property(property="limit_tahun_remisi", type="integer"),
     *      @OA\Property(property="lap_reg_scheduler", type="time"),
     *      @OA\Property(property="tgl_pemberlakuan_permen", type="date"),
     *      @OA\Property(property="ip", type="string"),
     *      @OA\Property(property="login", type="string"),
     *      @OA\Property(property="password", type="string"),
     *      @OA\Property(property="sdp_ada", type="boolean"),
     *      @OA\Property(property="email", type="string"),
     *      @OA\Property(property="website", type="string"),
     *      @OA\Property(property="rupbasan_id", type="bigint"),
     *      @OA\Property(property="bapas_id", type="bigint"),
 * )
 * @property int id
     * @property bigint id_upt
     * @property string uraian
     * @property integer kanwil
     * @property string jenis
     * @property string kelas
     * @property integer kapasitas
     * @property string alamat
     * @property string telpon
     * @property string fax
     * @property string kepala_upt
     * @property string jabatan_ku
     * @property string pangkat_ku
     * @property string nip_ku
     * @property string pejabat_upt
     * @property string jabatan_pu
     * @property string pangkat_pu
     * @property string nip_pu
     * @property text histori_remisi_tertentu
     * @property string dati2
     * @property boolean regf_month
     * @property integer kapasitas_kunjungan
     * @property integer limit_kunjungan
     * @property integer tahun_remisi
     * @property integer limit_tahun_remisi
     * @property time lap_reg_scheduler
     * @property date tgl_pemberlakuan_permen
     * @property string ip
     * @property string login
     * @property string password
     * @property boolean sdp_ada
     * @property string email
     * @property string website
     * @property bigint rupbasan_id
     * @property bigint bapas_id
 */
class Upt extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "upt";
    protected $primaryKey = "id_upt";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'uraian' ,'kanwil' ,'jenis' ,'kelas' ,'kapasitas' ,'alamat' ,'telpon' ,'fax' ,'kepala_upt' ,'jabatan_ku' ,'pangkat_ku' ,'nip_ku' ,'pejabat_upt' ,'jabatan_pu' ,'pangkat_pu' ,'nip_pu' ,'histori_remisi_tertentu' ,'dati2' ,'regf_month' ,'kapasitas_kunjungan' ,'limit_kunjungan' ,'tahun_remisi' ,'limit_tahun_remisi' ,'lap_reg_scheduler' ,'tgl_pemberlakuan_permen' ,'ip' ,'login' ,'password' ,'sdp_ada' ,'email' ,'website' ,'rupbasan_id' ,'bapas_id'
    ];

    protected $orderable = [
        'uraian' ,'kanwil' ,'jenis' ,'kelas' ,'kapasitas' ,'alamat' ,'telpon' ,'fax' ,'kepala_upt' ,'jabatan_ku' ,'pangkat_ku' ,'nip_ku' ,'pejabat_upt' ,'jabatan_pu' ,'pangkat_pu' ,'nip_pu' ,'histori_remisi_tertentu' ,'dati2' ,'regf_month' ,'kapasitas_kunjungan' ,'limit_kunjungan' ,'tahun_remisi' ,'limit_tahun_remisi' ,'lap_reg_scheduler' ,'tgl_pemberlakuan_permen' ,'ip' ,'login' ,'password' ,'sdp_ada' ,'email' ,'website' ,'rupbasan_id' ,'bapas_id'
    ];

    protected $searchable = [
        'uraian' ,'kanwil' ,'jenis' ,'kelas' ,'kapasitas' ,'alamat' ,'telpon' ,'fax' ,'kepala_upt' ,'jabatan_ku' ,'pangkat_ku' ,'nip_ku' ,'pejabat_upt' ,'jabatan_pu' ,'pangkat_pu' ,'nip_pu' ,'histori_remisi_tertentu' ,'dati2' ,'regf_month' ,'kapasitas_kunjungan' ,'limit_kunjungan' ,'tahun_remisi' ,'limit_tahun_remisi' ,'lap_reg_scheduler' ,'tgl_pemberlakuan_permen' ,'ip' ,'login' ,'password' ,'sdp_ada' ,'email' ,'website' ,'rupbasan_id' ,'bapas_id'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_upt;
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
