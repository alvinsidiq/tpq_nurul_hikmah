<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $jadwals = Jadwal::with(['kelas','mapel'])
            ->when(!$user->hasRole('admin'), fn ($q) => $q->where('guru_id', $user->id))
            ->orderBy('kelas_id')
            ->orderBy('mata_pelajaran_id')
            ->get();
        $semesters = Semester::orderByDesc('tanggal_mulai')->pluck('nama','id');
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->pluck('nama','id');
        $tanggal = now()->toDateString();
        $jenisPenilaian = Nilai::jenisPenilaianOptions();
        $jenisLabels = Nilai::jenisPenilaianLabels();
        $bobot = Nilai::bobotPenilaian();
        $ambangNaik = Nilai::ambangNaik();

        $rekapQuery = Nilai::query()
            ->join('santris', 'santris.id', '=', 'nilais.santri_id')
            ->join('kelas', 'kelas.id', '=', 'santris.kelas_id')
            ->join('mata_pelajarans as mp', 'mp.id', '=', 'nilais.mata_pelajaran_id')
            ->join('semesters as sem', 'sem.id', '=', 'nilais.semester_id')
            ->join('tahun_ajarans as ta', 'ta.id', '=', 'nilais.tahun_ajaran_id')
            ->selectRaw('kelas.id as kelas_id, kelas.nama_kelas, mp.nama as mapel, sem.nama as semester, ta.nama as tahun_ajaran, nilais.mata_pelajaran_id, nilais.semester_id, nilais.tahun_ajaran_id, nilais.jenis_penilaian, DATE(nilais.tanggal) as tgl, COUNT(*) as total')
            ->groupBy('kelas.id', 'kelas.nama_kelas', 'mp.nama', 'sem.nama', 'ta.nama', 'nilais.mata_pelajaran_id', 'nilais.semester_id', 'nilais.tahun_ajaran_id', 'nilais.jenis_penilaian', 'tgl')
            ->orderByDesc('tgl')
            ->orderBy('kelas.nama_kelas');

        if (!$user->hasRole('admin')) {
            $rekapQuery->whereExists(function ($q) use ($user) {
                $q->selectRaw('1')
                    ->from('jadwals')
                    ->whereColumn('jadwals.kelas_id', 'kelas.id')
                    ->whereColumn('jadwals.mata_pelajaran_id', 'nilais.mata_pelajaran_id')
                    ->where('jadwals.guru_id', $user->id);
            });
        }

        $rekap = $rekapQuery->paginate(12);

        return view('guru.nilai.index', compact('jadwals','semesters','tahunAjarans','tanggal','rekap','jenisPenilaian','jenisLabels','bobot','ambangNaik'));
    }

    public function start(Request $request)
    {
        $jenis = array_keys(Nilai::jenisPenilaianOptions());
        $data = $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'jenis_penilaian' => 'required|in:'.implode(',', $jenis),
            'tanggal' => 'required|date',
        ]);

        $jadwalQuery = Jadwal::query()->with(['kelas','mapel'])->where('id', $data['jadwal_id']);
        if (!auth()->user()->hasRole('admin')) {
            $jadwalQuery->where('guru_id', auth()->id());
        }
        $jadwal = $jadwalQuery->firstOrFail();

        return redirect()->route('guru.nilai.form', [
            $jadwal->kelas_id,
            'mata_pelajaran_id' => $jadwal->mata_pelajaran_id,
            'semester_id' => $data['semester_id'],
            'tahun_ajaran_id' => $data['tahun_ajaran_id'],
            'jenis_penilaian' => $data['jenis_penilaian'],
            'tanggal' => $data['tanggal'],
        ]);
    }

    public function form(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $allowedJenis = array_keys(Nilai::jenisPenilaianLabels());
        $data = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'jenis_penilaian' => 'required|in:'.implode(',', $allowedJenis),
            'tanggal' => 'required|date',
        ]);
        $this->ensureGuruMapel($kelas, (int) $data['mata_pelajaran_id']);

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
        $allowedJenis = array_keys(Nilai::jenisPenilaianLabels());
        $data = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'semester_id' => 'required|exists:semesters,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'jenis_penilaian' => 'required|in:'.implode(',', $allowedJenis),
            'tanggal' => 'required|date',
            'skor' => 'array',
            'skor.*' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'array',
            'catatan.*' => 'nullable|string|max:255',
        ]);
        $this->ensureGuruMapel($kelas, (int) $data['mata_pelajaran_id']);

        foreach (($data['skor'] ?? []) as $santriId => $skor) {
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

    private function ensureGuruMapel(Kelas $kelas, int $mapelId): void
    {
        if (auth()->user()->hasRole('admin')) {
            return;
        }

        $allowed = Jadwal::where('kelas_id', $kelas->id)
            ->where('mata_pelajaran_id', $mapelId)
            ->where('guru_id', auth()->id())
            ->exists();

        if (!$allowed) {
            abort(403, 'Anda tidak memiliki akses untuk mengisi nilai mapel ini.');
        }
    }
}
