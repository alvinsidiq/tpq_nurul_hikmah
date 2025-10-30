<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KehadiranController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('guru_id', auth()->id())->orderBy('nama_kelas')->pluck('nama_kelas', 'id');
        $tanggal = now()->toDateString();
        return view('guru.kehadiran.index', compact('kelas','tanggal'));
    }

    public function form(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $tanggal = $request->get('tanggal', now()->toDateString());

        $santri = Santri::where('kelas_id', $kelas->id)->orderBy('nama_lengkap')->get();
        $existing = Kehadiran::where('kelas_id', $kelas->id)
            ->whereDate('tanggal', $tanggal)
            ->get()->keyBy('santri_id');

        return view('guru.kehadiran.form', compact('kelas','tanggal','santri','existing'));
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
                Kehadiran::updateOrCreate(
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
            }
        });

        return redirect()->route('guru.kehadiran.form', [$kelas, 'tanggal' => $tanggal])
            ->with('success', 'Presensi disimpan');
    }
}

