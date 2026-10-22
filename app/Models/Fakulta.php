<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakulta extends Model
{
    use HasFactory;

    // @dbml-sync:table-property
    protected $table = 'fakultas';

    protected $primaryKey = 'id_fakultas';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;
    // @enddbml-sync:table-property

    // @dbml-sync:fillable
    protected $fillable = [
        'nama_fakultas',
        'no_gedung',
    ];
    // @enddbml-sync:fillable

    // @dbml-sync:casts
    protected $casts = [

    ];
    // @enddbml-sync:casts

    // @dbml-sync:relations
    public function prodis()
    {
        return $this->hasMany(Prodi::class, 'id_fakultas', 'id_fakultas');
    }

    // @enddbml-sync:relations
}
