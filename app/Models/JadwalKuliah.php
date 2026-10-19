<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'jadwal_kuliah';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'id_kelas',
		'hari',
		'jam_mulai',
		'jam_selesai',
		'ruangan'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'jam_mulai' => 'datetime',
		'jam_selesai' => 'datetime'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function kela()
    {
        return $this->belongsTo(Kela::class, 'id_kelas', 'id_kelas');
    }

    // @enddbml-sync:relations
}