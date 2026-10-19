<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kh extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nim',
		'semester',
		'ips',
		'total_sks'
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [
        
    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // @enddbml-sync:relations
}