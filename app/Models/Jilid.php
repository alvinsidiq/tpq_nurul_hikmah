<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jilid extends Model
{
    protected $guarded = [];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }

    public function mataPelajarans(): HasMany
    {
        return $this->hasMany(MataPelajaran::class, 'level_id');
    }
}
