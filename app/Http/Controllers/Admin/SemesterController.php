<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSemesterRequest;
use App\Http\Requests\Admin\UpdateSemesterRequest;
use App\Models\ActivityLog;
use App\Models\Semester;
use App\Models\TahunAjaran;

class SemesterController extends Controller
{
    public function index()
    {
        $items = Semester::with('tahunAjaran')
            ->orderByDesc('aktif')
            ->latest('tanggal_mulai')
            ->paginate(10);

        return view('admin.akademik.semesters.index', compact('items'));
    }

    public function create()
    {
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->get();
        return view('admin.akademik.semesters.form', [
            'item' => new Semester(),
            'tahunAjarans' => $tahunAjarans,
        ]);
    }

    public function store(StoreSemesterRequest $request)
    {
        $data = $request->validated();
        $sem = Semester::create($data);
        if (!empty($data['aktif'])) {
            Semester::where('id','!=',$sem->id)->update(['aktif'=>false]);
        }
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'create semester','ref_type'=>'semester','ref_id'=>$sem->id]);

        return redirect()->route('admin.semesters.index')->with('success','Periode pengajaran ditambahkan');
    }

    public function edit(Semester $semester)
    {
        $tahunAjarans = TahunAjaran::orderByDesc('tanggal_mulai')->get();
        return view('admin.akademik.semesters.form', [
            'item' => $semester,
            'tahunAjarans' => $tahunAjarans,
        ]);
    }

    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        $data = $request->validated();
        $semester->update($data);
        if (!empty($data['aktif'])) {
            Semester::where('id','!=',$semester->id)->update(['aktif'=>false]);
        }
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'update semester','ref_type'=>'semester','ref_id'=>$semester->id]);

        return redirect()->route('admin.semesters.index')->with('success','Periode pengajaran diperbarui');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return back()->with('success','Periode dihapus');
    }
}
