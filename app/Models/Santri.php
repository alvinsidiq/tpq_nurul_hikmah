<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Santri extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jilid(): BelongsTo
    {
        return $this->belongsTo(Jilid::class);
    }

    public function wali(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_user_id');
    }
}
