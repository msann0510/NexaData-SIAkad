<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'matakuliah';

    protected $primaryKey = 'kode_mk';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_mk',
        'sks',
        'semester',
        'id_prodi',
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [

    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function kelas()
    {
        return $this->hasMany(Kela::class, 'kode_mk', 'kode_mk');
    }

    // @enddbml-sync:relations
}
