<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';

    public function nota():BelongsTo{
        return $this->belongsTo(DetailPengiriman::class, 'no_nota');
    }
    public function layanan():HasOne{
        return $this->hasOne(Layanan::class, 'id_layanan');
    }
    public function histori():HasMany{
        return $this->hasMany(Histori::class, 'id_pengiriman');
    }
    public function detail():HasOne{
        return $this->hasOne(DetailPengiriman::class, 'id_pengiriman');
    }
}
