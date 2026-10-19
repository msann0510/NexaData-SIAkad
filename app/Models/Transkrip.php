<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transkrip extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'transkrip';
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nim',
		'ipk',
		'total_sks_lulus',
		'tanggal_cetak'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        'tanggal_cetak' => 'date'
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // @enddbml-sync:relations
}