<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSantriRequest;
use App\Http\Requests\Admin\UpdateSantriRequest;
use App\Models\Jilid;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\User;

class SantriController extends Controller
{
    public function index()
    {
        $items = Santri::with(['kelas','wali','jilid'])->latest()->paginate(12);
        return view('admin.santri.index', compact('items'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->pluck('nama_kelas','id');
        $jilids = Jilid::orderBy('urutan')->pluck('nama', 'id');
        $walis = User::role('wali_santri')->orderBy('name')->pluck('name','id');
        return view('admin.santri.form', ['item' => new Santri(), 'kelas' => $kelas, 'jilids' => $jilids, 'walis' => $walis]);
    }

    public function store(StoreSantriRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('foto')) {
            $data['foto_path'] = $r->file('foto')->store('santri', 'public');
        }
        unset($data['foto']);
        Santri::create($data);
        return redirect()->route('admin.santri.index')->with('success','Santri dibuat');
    }

    public function edit(Santri $santri)
    {
        $kelas = Kelas::orderBy('nama_kelas')->pluck('nama_kelas','id');
        $jilids = Jilid::orderBy('urutan')->pluck('nama', 'id');
        $walis = User::role('wali_santri')->orderBy('name')->pluck('name','id');
        return view('admin.santri.form', ['item' => $santri, 'kelas' => $kelas, 'jilids' => $jilids, 'walis' => $walis]);
    }

    public function update(UpdateSantriRequest $r, Santri $santri)
    {
        $data = $r->validated();
        if ($r->hasFile('foto')) {
            $data['foto_path'] = $r->file('foto')->store('santri', 'public');
        }
        unset($data['foto']);
        $santri->update($data);
        return redirect()->route('admin.santri.index')->with('success','Santri diperbarui');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();
        return back()->with('success','Santri dihapus');
    }
}
