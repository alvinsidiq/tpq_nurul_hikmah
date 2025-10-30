<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJadwalRequest;
use App\Http\Requests\Admin\UpdateJadwalRequest;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        $items = Jadwal::with(['kelas','mapel','guru'])
            ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(20);
        return view('admin.jadwal.index', compact('items'));
    }

    protected function lists(): array
    {
        $kelas = Kelas::orderBy('nama_kelas')->pluck('nama_kelas','id');
        $mapel = MataPelajaran::orderBy('nama')->pluck('nama','id');
        $gurus = User::role('guru')->orderBy('name')->pluck('name','id');
        $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        return compact('kelas','mapel','gurus','hari');
    }

    public function create()
    {
        return view('admin.jadwal.form', array_merge(['item' => new Jadwal()], $this->lists()));
    }

    public function store(StoreJadwalRequest $r)
    {
        Jadwal::create($r->validated());
        return redirect()->route('admin.jadwal.index')->with('success','Jadwal dibuat');
    }

    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.form', array_merge(['item' => $jadwal], $this->lists()));
    }

    public function update(UpdateJadwalRequest $r, Jadwal $jadwal)
    {
        $jadwal->update($r->validated());
        return redirect()->route('admin.jadwal.index')->with('success','Jadwal diperbarui');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return back()->with('success','Jadwal dihapus');
    }
}
