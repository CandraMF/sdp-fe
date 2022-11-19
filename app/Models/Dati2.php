<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dati2
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="Dati2"),
 *      description="Dati2 Model",
 *      type="object",
 *      title="Dati2 Model",
     *      @OA\Property(property="id_dati2", type="integer"),
     *      @OA\Property(property="deskripsi", type="string"),
     *      @OA\Property(property="id_provinsi", type="string"),
     *      @OA\Property(property="status", type="boolean"),
     *      @OA\Property(property="status_download", type="boolean"),
     *      @OA\Property(property="id_bps", type="string"),
 * )
 * @property int id
     * @property integer id_dati2
     * @property string deskripsi
     * @property string id_provinsi
     * @property boolean status
     * @property boolean status_download
     * @property string id_bps
 */
class Dati2 extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "dati2";
    protected $primaryKey = "id_dati2";
    public $timestamps = false;
    public $incrementing = false;    

    protected $fillable = [
        'deskripsi' ,'id_provinsi' ,'status' ,'status_download' ,'id_bps'
    ];

    protected $orderable = [
        'deskripsi' ,'id_provinsi' ,'status' ,'status_download' ,'id_bps'
    ];

    protected $searchable = [
        'deskripsi' ,'id_provinsi' ,'status' ,'status_download' ,'id_bps'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_dati2;
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
