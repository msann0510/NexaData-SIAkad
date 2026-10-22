<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'prodi';

    protected $primaryKey = 'id_prodi';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_prodi',
        'id_fakultas',
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [

    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function fakulta()
    {
        return $this->belongsTo(Fakulta::class, 'id_fakultas', 'id_fakultas');
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'id_prodi', 'id_prodi');
    }

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi', 'id_prodi');
    }

    public function matakuliahs()
    {
        return $this->hasMany(Matakuliah::class, 'id_prodi', 'id_prodi');
    }

    // @enddbml-sync:relations
}
