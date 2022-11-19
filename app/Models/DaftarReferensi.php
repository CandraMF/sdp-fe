<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DaftarReferensi
 * @package App\Models
 *
 * @OA\Schema(
 *      @OA\Xml(name="DaftarReferensi"),
 *      description="DaftarReferensi Model",
 *      type="object",
 *      title="DaftarReferensi Model",
 *      @OA\Property(property="id_lookup", type="string"),
 *      @OA\Property(property="groups", type="string"),
 *      @OA\Property(property="deskripsi", type="string"),
 *      @OA\Property(property="catatan", type="string"),
 *      @OA\Property(property="content", type="text"),
 *      @OA\Property(property="status_download", type="boolean"),
 * )
 * @property int id
 * @property string id_lookup
 * @property string groups
 * @property string deskripsi
 * @property string catatan
 * @property text content
 * @property boolean status_download
 */
class DaftarReferensi extends Model
{

    use HasFactory; //, SoftDeletes;

    protected $table = "daftar_referensi";
    protected $primaryKey = "id_lookup";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id_lookup', 'groups', 'deskripsi', 'catatan', 'content', 'status_download'
    ];

    protected $orderable = [
        'groups', 'deskripsi', 'catatan', 'content', 'status_download'
    ];

    protected $searchable = [
        'groups', 'deskripsi', 'catatan', 'content', 'status_download'
    ];

    /**
     * get key value
     *
     * @var string
     */
    public function getKey()
    {
        return $this->id_lookup;
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
