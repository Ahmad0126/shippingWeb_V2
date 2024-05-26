<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Histori extends Model
{
    use HasFactory;
    protected $table = 'histori';

    public function pengiriman():BelongsTo{
        return $this->belongsTo(Pengiriman::class, 'id_pengiriman');
    }
    public function cabang():BelongsTo{
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'id_user');
    }
}
