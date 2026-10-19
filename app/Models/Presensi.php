<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'presensi';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nim',
		'id_kelas',
		'tanggal',
		'pertemuan_ke',
		'status_hadir'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal' => 'date'
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