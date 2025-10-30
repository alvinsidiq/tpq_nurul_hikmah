<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KenaikanJilid extends Model
{
    protected $guarded = [];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}

