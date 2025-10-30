<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTahunAjaranRequest;
use App\Http\Requests\Admin\UpdateTahunAjaranRequest;
use App\Models\ActivityLog;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $items = TahunAjaran::latest()->paginate(10);
        return view('admin.ta.index', compact('items'));
    }

    public function create()
    {
        return view('admin.ta.form', ['item' => new TahunAjaran()]);
    }

    public function store(StoreTahunAjaranRequest $r)
    {
        $ta = TahunAjaran::create($r->validated());
        if ($ta->aktif) {
            TahunAjaran::where('id', '!=', $ta->id)->update(['aktif' => false]);
        }
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'create ta','ref_type'=>'tahun_ajaran','ref_id'=>$ta->id]);
        return redirect()->route('admin.ta.index')->with('success','Tahun ajaran dibuat');
    }

    public function edit(TahunAjaran $ta)
    {
        return view('admin.ta.form', ['item' => $ta]);
    }

    public function update(UpdateTahunAjaranRequest $r, TahunAjaran $ta)
    {
        $ta->update($r->validated());
        if ($ta->aktif) {
            TahunAjaran::where('id', '!=', $ta->id)->update(['aktif' => false]);
        }
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'update ta','ref_type'=>'tahun_ajaran','ref_id'=>$ta->id]);
        return redirect()->route('admin.ta.index')->with('success','Tahun ajaran diperbarui');
    }

    public function destroy(TahunAjaran $ta)
    {
        $ta->delete();
        return back()->with('success','Dihapus');
    }
}
