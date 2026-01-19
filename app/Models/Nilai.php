<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $guarded = [];

    public static function jenisPenilaianOptions(): array
    {
        return config('penilaian.jenis', []);
    }

    public static function jenisPenilaianLabels(): array
    {
        return array_merge(
            config('penilaian.jenis', []),
            config('penilaian.legacy', [])
        );
    }

    public static function bobotPenilaian(): array
    {
        return config('penilaian.bobot', []);
    }

    public static function ambangNaik(): int
    {
        return (int) config('penilaian.ambang_naik', 70);
    }

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
