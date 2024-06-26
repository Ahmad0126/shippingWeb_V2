<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cabang extends Model
{
    use HasFactory;
    protected $table = 'cabang';

    public function histori():HasMany{
        return $this->hasMany(Histori::class, 'id_cabang');
    }
}
