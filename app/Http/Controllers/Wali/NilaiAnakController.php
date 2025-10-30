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

        $mapels = MataPelajaran::orderBy('nama')->pluck('nama', 'id');
        $semesters = Semester::orderByDesc('tanggal_mulai')->pluck('nama', 'id');
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->pluck('nama', 'id');

        $santriId = (int) $request->get('santri_id');
        if ($anak->count() === 1) {
            $santriId = $santriId ?: (int) $anak->first()->id;
        }

        $q = Nilai::query()->with(['mapel','semester','tahunAjaran'])
            ->whereHas('santri', function ($w) use ($waliId) {
                $w->where('wali_user_id', $waliId);
            });

        if ($santriId) {
            $q->where('santri_id', $santriId);
        }
        if ($request->filled('mata_pelajaran_id')) {
            $q->where('mata_pelajaran_id', (int) $request->mata_pelajaran_id);
        }
        if ($request->filled('semester_id')) {
            $q->where('semester_id', (int) $request->semester_id);
        }
        if ($request->filled('tahun_ajaran_id')) {
            $q->where('tahun_ajaran_id', (int) $request->tahun_ajaran_id);
        }

        $items = $q->orderByDesc('tanggal')->orderBy('jenis_penilaian')->paginate(20)->withQueryString();

        return view('wali.nilai.index', [
            'anak' => $anak,
            'mapels' => $mapels,
            'semesters' => $semesters,
            'tahunAjarans' => $tahunAjarans,
            'items' => $items,
            'selected' => [
                'santri_id' => $santriId ?: null,
                'mata_pelajaran_id' => $request->get('mata_pelajaran_id'),
                'semester_id' => $request->get('semester_id'),
                'tahun_ajaran_id' => $request->get('tahun_ajaran_id'),
            ],
        ]);
    }
}

