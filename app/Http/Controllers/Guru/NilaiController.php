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
        return view('guru.nilai.index', compact('kelas','mapels','semesters','tahunAjarans','tanggal'));
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
            'skors' => 'required|array',
            'skors.*' => 'nullable|numeric|min:0',
            'catatan' => 'array',
        ]);

        foreach ($data['skors'] as $santriId => $skor) {
            if ($skor === null || $skor === '') {
                continue;
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
                    'skor' => $skor,
                    'catatan' => $data['catatan'][$santriId] ?? null,
                ]
            );
        }

        return back()->with('success','Nilai disimpan');
    }
}

