<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';

    public function pengiriman():BelongsTo{
        return $this->belongsTo(Pengiriman::class, 'id_layanan');
    }
}
