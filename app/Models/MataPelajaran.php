<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'mata_pelajaran_id');
    }

    public function jilid(): BelongsTo
    {
        return $this->belongsTo(Jilid::class, 'level_id');
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'mata_pelajaran_id');
    }
}
