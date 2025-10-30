<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\UpdateKelasSayaRequest;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class KelasSayaController extends Controller
{
    public function index()
    {
        $items = Kelas::where('guru_id', auth()->id())->orderBy('nama_kelas')->paginate(12);
        return view('guru.kelas.index', compact('items'));
    }

    public function show(Request $request, Kelas $kelas)
    {
        $this->authorize('view', $kelas);
        $q = trim((string) $request->get('q'));
        $jilid = $request->get('jilid_level');

        $santriQuery = Santri::where('kelas_id', $kelas->id);
        if ($q !== '') {
            $santriQuery->where(function ($sub) use ($q) {
                $sub->where('nama_lengkap', 'like', "%$q%")
                    ->orWhere('nis', 'like', "%$q%");
            });
        }
        if ($jilid !== null && $jilid !== '') {
            $santriQuery->where('jilid_level', (int) $jilid);
        }
        $santri = $santriQuery->orderBy('nama_lengkap')->paginate(15)->withQueryString();

        return view('guru.kelas.show', compact('kelas', 'santri', 'q', 'jilid'));
    }

    public function edit(Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        return view('guru.kelas.form', ['item' => $kelas]);
    }

    public function update(UpdateKelasSayaRequest $request, Kelas $kelas)
    {
        $this->authorize('update', $kelas);
        $data = $request->validated();
        $kelas->update($data);
        return redirect()->route('guru.kelas.index')->with('success', 'Kelas diperbarui');
    }
}
