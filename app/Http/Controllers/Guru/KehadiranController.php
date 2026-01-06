<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Kehadiran;
use App\Notifications\KehadiranWaliNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KehadiranController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('guru_id', auth()->id())->orderBy('nama_kelas')->pluck('nama_kelas', 'id');
        $tanggal = now()->toDateString();

        $kelasIds = $kelas->keys();
        $rekap = Kehadiran::query()
            ->whereIn('kelas_id', $kelasIds)
            ->join('kelas', 'kelas.id', '=', 'kehadirans.kelas_id')
            ->selectRaw('kehadirans.kelas_id, kelas.nama_kelas, DATE(kehadirans.tanggal) as tgl, COUNT(*) as total')
            ->groupBy('kehadirans.kelas_id', 'kelas.nama_kelas', 'tgl')
            ->orderByDesc('tgl')
            ->orderBy('kelas.nama_kelas')
            ->paginate(12);

        return view('guru.kehadiran.index', [
            'kelas' => $kelas,
            'tanggal' => $tanggal,
            'rekap' => $rekap,
        ]);
    }

    public function form(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $tanggal = $request->get('tanggal', now()->toDateString());

        $santri = Santri::where('kelas_id', $kelas->id)->orderBy('nama_lengkap')->get();
        $existing = Kehadiran::where('kelas_id', $kelas->id)
            ->whereDate('tanggal', $tanggal)
            ->get()->keyBy('santri_id');

        $isLockedDate = $existing->isNotEmpty();

        return view('guru.kehadiran.form', compact('kelas','tanggal','santri','existing','isLockedDate'));
    }

    public function store(Request $request, Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        $data = $request->validate([
            'tanggal' => 'required|date',
            'statuses' => 'required|array',
            'statuses.*' => 'required|in:H,I,S,A',
            'keterangan' => 'array',
        ]);

        $tanggal = $data['tanggal'];
        $statuses = $data['statuses'];
        $kets = $data['keterangan'] ?? [];

        DB::transaction(function () use ($kelas, $tanggal, $statuses, $kets) {
            foreach ($statuses as $santriId => $status) {
                $kehadiran = Kehadiran::updateOrCreate(
                    [
                        'santri_id' => (int) $santriId,
                        'tanggal' => $tanggal,
                        'kelas_id' => $kelas->id,
                    ],
                    [
                        'status' => $status,
                        'keterangan' => $kets[$santriId] ?? null,
                    ]
                );

                // Kirim notifikasi email ke wali santri jika tersedia
                $santri = Santri::with('wali','kelas')->find($santriId);
                if ($santri && $santri->wali && $santri->wali->email) {
                    $santri->wali->notify(new KehadiranWaliNotification(
                        $santri,
                        $status,
                        $tanggal,
                        $kets[$santriId] ?? null
                    ));
                }
            }
        });

        return redirect()->route('guru.kehadiran.daily', [$kelas, 'tanggal' => $tanggal])
            ->with('success', 'Presensi disimpan');
    }

    public function daily(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $tanggal = $request->get('tanggal', now()->toDateString());

        $records = Kehadiran::with('santri')
            ->where('kehadirans.kelas_id', $kelas->id)
            ->whereDate('kehadirans.tanggal', $tanggal)
            ->join('santris', 'santris.id', '=', 'kehadirans.santri_id')
            ->orderBy('santris.nama_lengkap')
            ->select('kehadirans.*')
            ->get();

        return view('guru.kehadiran.daily', compact('kelas', 'tanggal', 'records'));
    }
}
