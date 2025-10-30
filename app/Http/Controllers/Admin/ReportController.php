<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected function filters(): array
    {
        return [
            'tahunAjarans' => TahunAjaran::orderByDesc('tanggal_mulai')->pluck('nama', 'id'),
            'semesters' => Semester::orderByDesc('tanggal_mulai')->pluck('nama', 'id'),
            'mapels' => MataPelajaran::orderBy('nama')->pluck('nama', 'id'),
            'kelas' => Kelas::orderBy('nama_kelas')->pluck('nama_kelas', 'id'),
        ];
    }

    public function kehadiran(Request $request)
    {
        return view('admin.reports.kehadiran', array_merge($this->filters(), [
            'q' => $request->only(['tahun_ajaran_id','semester_id','mapel_id','kelas_id']),
            'items' => collect(), // placeholder data
        ]));
    }

    public function nilai(Request $request)
    {
        return view('admin.reports.nilai', array_merge($this->filters(), [
            'q' => $request->only(['tahun_ajaran_id','semester_id','mapel_id','kelas_id']),
            'items' => collect(), // placeholder data
        ]));
    }

    public function rekapKelas(Request $request)
    {
        return view('admin.reports.rekap_kelas', array_merge($this->filters(), [
            'q' => $request->only(['tahun_ajaran_id','semester_id','mapel_id','kelas_id']),
            'items' => collect(), // placeholder data
        ]));
    }
}
