<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';

    public function pengiriman():HasMany{
        return $this->hasMany(Pengiriman::class, 'id_layanan');
    }
}
