<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'mahasiswa';
    // @enddbml-sync:table-property

    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    // @dbml-sync:fillable
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
		'jenis_kelamin',
		'tanggal_lahir',
		'alamat',
		'id_prodi'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_lahir' => 'date'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function khs()
    {
        return $this->hasMany(Kh::class, 'nim', 'nim');
    }

    public function krs()
    {
        return $this->hasMany(Kr::class, 'nim', 'nim');
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'nim', 'nim');
    }

    public function tanskrips()
    {
        return $this->hasMany(Tanskrip::class, 'nim', 'nim');
    }

    // @enddbml-sync:relations
}