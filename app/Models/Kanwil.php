<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kanwil
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Kanwil"),
 *      description="Kanwil Model",
 *      type="object",
 *      title="Kanwil Model",
     *      @OA\Property(property="kode", type="bigint"),
     *      @OA\Property(property="uraian", type="string"),
     *      @OA\Property(property="sdp_ada", type="boolean"),
     *      @OA\Property(property="alamat", type="string"),
     *      @OA\Property(property="telpon", type="string"),
     *      @OA\Property(property="fax", type="string"),
     *      @OA\Property(property="kepala_kanwil", type="string"),
     *      @OA\Property(property="jabatan_kw", type="string"),
     *      @OA\Property(property="pangkat_kw", type="string"),
     *      @OA\Property(property="nip_kw", type="string"),
     *      @OA\Property(property="pejabat_kanwil", type="string"),
     *      @OA\Property(property="jabatan_pw", type="string"),
     *      @OA\Property(property="pangkat_pw", type="string"),
     *      @OA\Property(property="nip_pw", type="string"),
     *      @OA\Property(property="ip", type="string"),
     *      @OA\Property(property="login", type="string"),
     *      @OA\Property(property="password", type="string"),
     *      @OA\Property(property="id_provinsi", type="string"),
     *      @OA\Property(property="id_dati2", type="integer"),
     *      @OA\Property(property="status_download", type="boolean"),
     *      @OA\Property(property="email", type="string"),
     *      @OA\Property(property="website", type="string"),
     *      @OA\Property(property="konsolidasi", type="integer"),
     *      @OA\Property(property="is_konsolidasi_offline", type="boolean"),
     *      @OA\Property(property="nama_aplikasi", type="string"),
     *      @OA\Property(property="pin", type="string"),
     *      @OA\Property(property="id_timezone", type="string"),
     *      @OA\Property(property="versions", type="string"),
     *      @OA\Property(property="versions_date", type="date"),
     *      @OA\Property(property="backup_scheduler", type="time"),
     *      @OA\Property(property="lap_reg_scheduler", type="time"),
     *      @OA\Property(property="konsolidasi_scheduler", type="time"),
     *      @OA\Property(property="konsolidasi_scheduler_interval", type="integer"),
     *      @OA\Property(property="konsolidasi_integrasi_scheduler", type="time"),
     *      @OA\Property(property="terima_data_integrasi_scheduler", type="time"),
     *      @OA\Property(property="terima_data_integrasi_scheduler_interval", type="integer"),
     *      @OA\Property(property="increament_backup_number", type="integer"),
     *      @OA\Property(property="increament_backup_time", type="datetime"),
 * )
 * @property int id
     * @property bigint kode
     * @property string uraian
     * @property boolean sdp_ada
     * @property string alamat
     * @property string telpon
     * @property string fax
     * @property string kepala_kanwil
     * @property string jabatan_kw
     * @property string pangkat_kw
     * @property string nip_kw
     * @property string pejabat_kanwil
     * @property string jabatan_pw
     * @property string pangkat_pw
     * @property string nip_pw
     * @property string ip
     * @property string login
     * @property string password
     * @property string id_provinsi
     * @property integer id_dati2
     * @property boolean status_download
     * @property string email
     * @property string website
     * @property integer konsolidasi
     * @property boolean is_konsolidasi_offline
     * @property string nama_aplikasi
     * @property string pin
     * @property string id_timezone
     * @property string versions
     * @property date versions_date
     * @property time backup_scheduler
     * @property time lap_reg_scheduler
     * @property time konsolidasi_scheduler
     * @property integer konsolidasi_scheduler_interval
     * @property time konsolidasi_integrasi_scheduler
     * @property time terima_data_integrasi_scheduler
     * @property integer terima_data_integrasi_scheduler_interval
     * @property integer increament_backup_number
     * @property datetime increament_backup_time
 */
class Kanwil extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "kanwil";
    protected $primaryKey = "kode";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'uraian' ,'sdp_ada' ,'alamat' ,'telpon' ,'fax' ,'kepala_kanwil' ,'jabatan_kw' ,'pangkat_kw' ,'nip_kw' ,'pejabat_kanwil' ,'jabatan_pw' ,'pangkat_pw' ,'nip_pw' ,'ip' ,'login' ,'password' ,'id_provinsi' ,'id_dati2' ,'status_download' ,'email' ,'website' ,'konsolidasi' ,'is_konsolidasi_offline' ,'nama_aplikasi' ,'pin' ,'id_timezone' ,'versions' ,'versions_date' ,'backup_scheduler' ,'lap_reg_scheduler' ,'konsolidasi_scheduler' ,'konsolidasi_scheduler_interval' ,'konsolidasi_integrasi_scheduler' ,'terima_data_integrasi_scheduler' ,'terima_data_integrasi_scheduler_interval' ,'increament_backup_number' ,'increament_backup_time'
    ];

    protected $orderable = [
        'uraian' ,'sdp_ada' ,'alamat' ,'telpon' ,'fax' ,'kepala_kanwil' ,'jabatan_kw' ,'pangkat_kw' ,'nip_kw' ,'pejabat_kanwil' ,'jabatan_pw' ,'pangkat_pw' ,'nip_pw' ,'ip' ,'login' ,'password' ,'id_provinsi' ,'id_dati2' ,'status_download' ,'email' ,'website' ,'konsolidasi' ,'is_konsolidasi_offline' ,'nama_aplikasi' ,'pin' ,'id_timezone' ,'versions' ,'versions_date' ,'backup_scheduler' ,'lap_reg_scheduler' ,'konsolidasi_scheduler' ,'konsolidasi_scheduler_interval' ,'konsolidasi_integrasi_scheduler' ,'terima_data_integrasi_scheduler' ,'terima_data_integrasi_scheduler_interval' ,'increament_backup_number' ,'increament_backup_time'
    ];

    protected $searchable = [
        'uraian' ,'sdp_ada' ,'alamat' ,'telpon' ,'fax' ,'kepala_kanwil' ,'jabatan_kw' ,'pangkat_kw' ,'nip_kw' ,'pejabat_kanwil' ,'jabatan_pw' ,'pangkat_pw' ,'nip_pw' ,'ip' ,'login' ,'password' ,'id_provinsi' ,'id_dati2' ,'status_download' ,'email' ,'website' ,'konsolidasi' ,'is_konsolidasi_offline' ,'nama_aplikasi' ,'pin' ,'id_timezone' ,'versions' ,'versions_date' ,'backup_scheduler' ,'lap_reg_scheduler' ,'konsolidasi_scheduler' ,'konsolidasi_scheduler_interval' ,'konsolidasi_integrasi_scheduler' ,'terima_data_integrasi_scheduler' ,'terima_data_integrasi_scheduler_interval' ,'increament_backup_number' ,'increament_backup_time'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->kode;
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
