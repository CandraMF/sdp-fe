<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PembinaanKepribadian
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="PembinaanKepribadian"),
 *      description="PembinaanKepribadian Model",
 *      type="object",
 *      title="PembinaanKepribadian Model",
     *      @OA\Property(property="id", type="bigint"),
     *      @OA\Property(property="id_jenis_pembinaan_kepribadian", type="string"),
     *      @OA\Property(property="id_upt", type="string"),
     *      @OA\Property(property="id_mitra", type="string"),
     *      @OA\Property(property="nama_program", type="string"),
     *      @OA\Property(property="program_wajib", type="boolean"),
     *      @OA\Property(property="materi_pembinaan_kepribadian", type="string"),
     *      @OA\Property(property="id_instruktur", type="string"),
     *      @OA\Property(property="penanggung_jawab", type="string"),
     *      @OA\Property(property="tanggal_mulai", type="date"),
     *      @OA\Property(property="tanggal_selesai", type="date"),
     *      @OA\Property(property="tempat_pelaksanaan", type="string"),
     *      @OA\Property(property="perlu_kelulusan", type="boolean"),
     *      @OA\Property(property="id_sarana", type="string"),
     *      @OA\Property(property="id_prasarana", type="string"),
     *      @OA\Property(property="realisasi_anggaran", type="decimal"),
     *      @OA\Property(property="id_jenis_anggaran", type="string"),
     *      @OA\Property(property="foto", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="status", type="string"),
     *      @OA\Property(property="updated_at", type="datetime"),
     *      @OA\Property(property="updated_by", type="string"),
 * )
 * @property int id
     * @property bigint id
     * @property string id_jenis_pembinaan_kepribadian
     * @property string id_upt
     * @property string id_mitra
     * @property string nama_program
     * @property boolean program_wajib
     * @property string materi_pembinaan_kepribadian
     * @property string id_instruktur
     * @property string penanggung_jawab
     * @property date tanggal_mulai
     * @property date tanggal_selesai
     * @property string tempat_pelaksanaan
     * @property boolean perlu_kelulusan
     * @property string id_sarana
     * @property string id_prasarana
     * @property decimal realisasi_anggaran
     * @property string id_jenis_anggaran
     * @property string foto
     * @property string keterangan
     * @property string status
     * @property datetime updated_at
     * @property string updated_by
 */
class PembinaanKepribadian extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "pembinaan_kepribadian";
    protected $primaryKey = "id";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'id_jenis_pembinaan_kepribadian' ,'id_upt' ,'id_mitra' ,'nama_program' ,'program_wajib' ,'materi_pembinaan_kepribadian' ,'id_instruktur' ,'penanggung_jawab' ,'tanggal_mulai' ,'tanggal_selesai' ,'tempat_pelaksanaan' ,'perlu_kelulusan' ,'id_sarana' ,'id_prasarana' ,'realisasi_anggaran' ,'id_jenis_anggaran' ,'foto' ,'keterangan' ,'status' , 'updated_at', 'updated_by'
    ];

    protected $orderable = [
        'id_jenis_pembinaan_kepribadian' ,'id_upt' ,'id_mitra' ,'nama_program' ,'program_wajib' ,'materi_pembinaan_kepribadian' ,'id_instruktur' ,'penanggung_jawab' ,'tanggal_mulai' ,'tanggal_selesai' ,'tempat_pelaksanaan' ,'perlu_kelulusan' ,'id_sarana' ,'id_prasarana' ,'realisasi_anggaran' ,'id_jenis_anggaran' ,'foto' ,'keterangan' ,'status' , 'updated_at', 'updated_by'
    ];

    protected $searchable = [
        'id_jenis_pembinaan_kepribadian' ,'id_upt' ,'id_mitra' ,'nama_program' ,'program_wajib' ,'materi_pembinaan_kepribadian' ,'id_instruktur' ,'penanggung_jawab' ,'tanggal_mulai' ,'tanggal_selesai' ,'tempat_pelaksanaan' ,'perlu_kelulusan' ,'id_sarana' ,'id_prasarana' ,'realisasi_anggaran' ,'id_jenis_anggaran' ,'foto' ,'keterangan' ,'status' , 'updated_at', 'updated_by'
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
