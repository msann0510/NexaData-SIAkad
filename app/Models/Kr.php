<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kr extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'krs';

    protected $primaryKey = 'id_krs';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nim',
        'id_kelas',
        'semester',
        'tanggal_krs',
        'status_krs',
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_krs' => 'date',
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function kela()
    {
        return $this->belongsTo(Kela::class, 'id_kelas', 'id_kelas');
    }

    // @enddbml-sync:relations
}
