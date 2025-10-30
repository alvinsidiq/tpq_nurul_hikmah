<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = [];

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
