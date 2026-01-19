<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $jadwals = Jadwal::with(['kelas','mapel'])
            ->when(!$user->hasRole('admin'), fn ($q) => $q->where('guru_id', $user->id))
            ->orderBy('mata_pelajaran_id')
            ->orderBy('kelas_id')
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.mapel.index', compact('jadwals'));
    }
}
