<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mitra
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Mitra"),
 *      description="Mitra Model",
 *      type="object",
 *      title="Mitra Model",
     *      @OA\Property(property="id_mitra", type="integer"),
     *      @OA\Property(property="nama_mitra", type="string"),
     *      @OA\Property(property="nama_pic", type="string"),
     *      @OA\Property(property="alamat", type="string"),
     *      @OA\Property(property="id_dati2", type="string"),
     *      @OA\Property(property="no_telp", type="string"),
     *      @OA\Property(property="no_hp", type="string"),
     *      @OA\Property(property="email", type="string"),
     *      @OA\Property(property="keterangan", type="string"),
     *      @OA\Property(property="update_terakhir", type="datetime"),
     *      @OA\Property(property="update_oleh", type="string"),
 * )
 * @property int id
     * @property integer id_mitra
     * @property string nama_mitra
     * @property string nama_pic
     * @property string alamat
     * @property string id_dati2
     * @property string no_telp
     * @property string no_hp
     * @property string email
     * @property string keterangan
     * @property datetime update_terakhir
     * @property string update_oleh
 */
class Mitra extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "mitra";
    protected $primaryKey = "id_mitra";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'nama_mitra' ,'nama_pic' ,'alamat' ,'id_dati2' ,'no_telp' ,'no_hp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $orderable = [
        'nama_mitra' ,'nama_pic' ,'alamat' ,'id_dati2' ,'no_telp' ,'no_hp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    protected $searchable = [
        'nama_mitra' ,'nama_pic' ,'alamat' ,'id_dati2' ,'no_telp' ,'no_hp' ,'email' ,'keterangan' ,'update_terakhir' ,'update_oleh'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_mitra;
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
