<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKegiatanRequest;
use App\Http\Requests\Admin\UpdateKegiatanRequest;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $items = Kegiatan::latest()->paginate(12);
        return view('admin.kegiatan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.kegiatan.form', ['item' => new Kegiatan()]);
    }

    public function store(StoreKegiatanRequest $r)
    {
        $k = Kegiatan::create($r->validated());

        // Notifikasi email dinonaktifkan

        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan dibuat');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.form', ['item' => $kegiatan]);
    }

    public function update(UpdateKegiatanRequest $r, Kegiatan $kegiatan)
    {
        $kegiatan->update($r->validated());

        // Notifikasi email dinonaktifkan

        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return back()->with('success','Kegiatan dihapus');
    }
}
