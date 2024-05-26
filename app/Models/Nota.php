<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nota extends Model
{
    use HasFactory;
    protected $table = 'nota';

    public function pengiriman():HasMany {
        return $this->hasMany(Pengiriman::class, 'id_pengiriman');
    }
}
