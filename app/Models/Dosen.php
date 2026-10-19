<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'dosen';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_dosen',
		'id_prodi'
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
        return $this->hasMany(Kela::class, 'id_dosen', 'id_dosen');
    }

    // @enddbml-sync:relations
}