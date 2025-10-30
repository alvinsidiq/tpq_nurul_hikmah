<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKelasRequest;
use App\Http\Requests\Admin\UpdateKelasRequest;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    public function index()
    {
        $items = Kelas::with('waliKelas')->paginate(12);
        return view('admin.akademik.kelas.index', compact('items'));
    }

    public function create()
    {
        $gurus = User::role('guru')->pluck('name', 'id');
        return view('admin.kelas.form', ['item' => new Kelas(), 'gurus' => $gurus]);
    }

    public function store(StoreKelasRequest $r)
    {
        Kelas::create($r->validated());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas dibuat');
    }

    public function edit(Kelas $kela)
    {
        $gurus = User::role('guru')->pluck('name', 'id');
        return view('admin.kelas.form', ['item' => $kela, 'gurus' => $gurus]);
    }

    public function update(UpdateKelasRequest $r, Kelas $kela)
    {
        $kela->update($r->validated());
        return redirect()->route('admin.kelas.index')->with('success', 'Diperbarui');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return back()->with('success', 'Dihapus');
    }
}
