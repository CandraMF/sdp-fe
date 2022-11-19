<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Provinsi
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Provinsi"),
 *      description="Provinsi Model",
 *      type="object",
 *      title="Provinsi Model",
     *      @OA\Property(property="id_provinsi", type="string"),
     *      @OA\Property(property="deskripsi", type="string"),
     *      @OA\Property(property="status_download", type="string"),
     *      @OA\Property(property="id_bps", type="string"),
     *      @OA\Property(property="id_negara", type="string"),
 * )
 * @property int id
     * @property string id_provinsi
     * @property string deskripsi
     * @property string status_download
     * @property string id_bps
     * @property string id_negara
 */
class Provinsi extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "provinsi";
    protected $primaryKey = "id_provinsi";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'deskripsi' ,'status_download' ,'id_bps' ,'id_negara'
    ];

    protected $orderable = [
        'deskripsi' ,'status_download' ,'id_bps' ,'id_negara'
    ];

    protected $searchable = [
        'deskripsi' ,'status_download' ,'id_bps' ,'id_negara'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_provinsi;
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
