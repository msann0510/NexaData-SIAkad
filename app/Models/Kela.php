<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kela extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_kelas',
		'kode_mk',
		'id_dosen'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function jadwalKuliahs()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_kelas', 'id_kelas');
    }

    public function krs()
    {
        return $this->hasMany(Kr::class, 'id_kelas', 'id_kelas');
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'id_kelas', 'id_kelas');
    }

    // @enddbml-sync:relations
}