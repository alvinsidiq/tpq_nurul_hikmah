<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMataPelajaranRequest;
use App\Http\Requests\Admin\UpdateMataPelajaranRequest;
use App\Models\ActivityLog;
use App\Models\MataPelajaran;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $items = MataPelajaran::latest()->paginate(10);
        return view('admin.mapel.index', compact('items'));
    }

    public function create()
    {
        return view('admin.mapel.form', ['item' => new MataPelajaran()]);
    }

    public function store(StoreMataPelajaranRequest $r)
    {
        $m = MataPelajaran::create($r->validated());
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'create mapel','ref_type'=>'mata_pelajaran','ref_id'=>$m->id]);
        return redirect()->route('admin.mapel.index')->with('success','Mata pelajaran dibuat');
    }

    public function edit(MataPelajaran $mapel)
    {
        return view('admin.mapel.form', ['item' => $mapel]);
    }

    public function update(UpdateMataPelajaranRequest $r, MataPelajaran $mapel)
    {
        $mapel->update($r->validated());
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'update mapel','ref_type'=>'mata_pelajaran','ref_id'=>$mapel->id]);
        return redirect()->route('admin.mapel.index')->with('success','Mata pelajaran diperbarui');
    }

    public function destroy(MataPelajaran $mapel)
    {
        $mapel->delete();
        return back()->with('success','Dihapus');
    }
}
