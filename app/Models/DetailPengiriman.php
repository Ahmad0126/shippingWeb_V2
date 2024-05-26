<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPengiriman extends Model
{
    use HasFactory;
    protected $table = 'detail_pengiriman';

    public function pengiriman():BelongsTo{
        return $this->belongsTo(Pengiriman::class, 'id_pengiriman');
    }
}
