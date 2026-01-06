<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiAnakController extends Controller
{
    public function index(Request $request)
    {
        $waliId = auth()->id();
        $anak = Santri::where('wali_user_id', $waliId)->orderBy('nama_lengkap')->get();
        $santriId = (int) optional($anak->first())->id;

        $q = Nilai::query()->with(['mapel','semester','tahunAjaran'])
            ->whereHas('santri', function ($w) use ($waliId) {
                $w->where('wali_user_id', $waliId);
            });

        if ($santriId) {
            $q->where('santri_id', $santriId);
        }

        $items = $q->orderByDesc('tanggal')->orderBy('jenis_penilaian')->paginate(20)->withQueryString();

        return view('wali.nilai.index', [
            'anak' => $anak,
            'items' => $items,
            'santriId' => $santriId ?: null,
        ]);
    }
}
