<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('guru_id', auth()->id())->orderBy('nama_kelas')->pluck('nama_kelas','id');
        $mapels = MataPelajaran::orderBy('nama')->pluck('nama','id');
        $semesters = Semester::orderByDesc('tanggal_mulai')->pluck('nama','id');
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->pluck('nama','id');
        $tanggal = now()->toDateString();

        $rekap = Nilai::query()
            ->join('santris', 'santris.id', '=', 'nilais.santri_id')
            ->join('kelas', 'kelas.id', '=', 'santris.kelas_id')
            ->join('mata_pelajarans as mp', 'mp.id', '=', 'nilais.mata_pelajaran_id')
            ->join('semesters as sem', 'sem.id', '=', 'nilais.semester_id')
            ->join('tahun_ajarans as ta', 'ta.id', '=', 'nilais.tahun_ajaran_id')
            ->where('kelas.guru_id', auth()->id())
            ->selectRaw('kelas.id as kelas_id, kelas.nama_kelas, mp.nama as mapel, sem.nama as semester, ta.nama as tahun_ajaran, nilais.mata_pelajaran_id, nilais.semester_id, nilais.tahun_ajaran_id, nilais.jenis_penilaian, DATE(nilais.tanggal) as tgl, COUNT(*) as total')
            ->groupBy('kelas.id', 'kelas.nama_kelas', 'mp.nama', 'sem.nama', 'ta.nama', 'nilais.mata_pelajaran_id', 'nilais.semester_id', 'nilais.tahun_ajaran_id', 'nilais.jenis_penilaian', 'tgl')
            ->orderByDesc('tgl')
            ->orderBy('kelas.nama_kelas')
            ->paginate(12);

        return view('guru.nilai.index', compact('kelas','mapels','semesters','tahunAjarans','tanggal','rekap'));
    }

    public function form(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $data = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'jenis_penilaian' => 'required|in:UH,UTS,UAS,Praktik',
            'tanggal' => 'required|date',
        ]);

        $santri = Santri::where('kelas_id', $kelas->id)->orderBy('nama_lengkap')->get();
        $existing = Nilai::whereIn('santri_id', $santri->pluck('id'))
            ->where('mata_pelajaran_id', $data['mata_pelajaran_id'])
            ->where('semester_id', $data['semester_id'])
            ->where('tahun_ajaran_id', $data['tahun_ajaran_id'])
            ->where('jenis_penilaian', $data['jenis_penilaian'])
            ->whereDate('tanggal', $data['tanggal'])
            ->get()->keyBy('santri_id');

        return view('guru.nilai.form', array_merge($data, compact('kelas','santri','existing')));
    }

    public function store(Request $request, Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        $data = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'jenis_penilaian' => 'required|in:UH,UTS,UAS,Praktik',
            'tanggal' => 'required|date',
            'tilawah' => 'array',
            'tilawah.*' => 'nullable|numeric|min:0|max:100',
            'tajwid' => 'array',
            'tajwid.*' => 'nullable|numeric|min:0|max:100',
            'hafalan' => 'array',
            'hafalan.*' => 'nullable|numeric|min:0|max:100',
            'adab' => 'array',
            'adab.*' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'array',
            'catatan.*' => 'nullable|string|max:255',
        ]);

        $ids = array_unique(array_merge(
            array_keys($data['tilawah'] ?? []),
            array_keys($data['tajwid'] ?? []),
            array_keys($data['hafalan'] ?? []),
            array_keys($data['adab'] ?? [])
        ));

        foreach ($ids as $santriId) {
            $components = [
                'Tilawah' => $data['tilawah'][$santriId] ?? null,
                'Tajwid' => $data['tajwid'][$santriId] ?? null,
                'Hafalan' => $data['hafalan'][$santriId] ?? null,
                'Adab' => $data['adab'][$santriId] ?? null,
            ];

            $scores = array_values(array_filter($components, fn ($v) => $v !== null && $v !== ''));
            if (count($scores) === 0) {
                continue;
            }

            $avg = array_sum($scores) / count($scores);
            $catatanParts = [];
            foreach ($components as $label => $val) {
                if ($val !== null && $val !== '') {
                    $catatanParts[] = "$label: $val";
                }
            }
            if (isset($data['catatan'][$santriId]) && $data['catatan'][$santriId] !== '') {
                $catatanParts[] = "Catatan: ".$data['catatan'][$santriId];
            }

            Nilai::updateOrCreate(
                [
                    'santri_id' => (int) $santriId,
                    'mata_pelajaran_id' => $data['mata_pelajaran_id'],
                    'semester_id' => $data['semester_id'],
                    'tahun_ajaran_id' => $data['tahun_ajaran_id'],
                    'jenis_penilaian' => $data['jenis_penilaian'],
                    'tanggal' => $data['tanggal'],
                ],
                [
                    'skor' => $avg,
                    'catatan' => implode('; ', $catatanParts),
                ]
            );
        }

        return back()->with('success','Nilai disimpan');
    }
}
