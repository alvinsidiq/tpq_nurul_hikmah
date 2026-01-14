<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKegiatanRequest;
use App\Http\Requests\Admin\UpdateKegiatanRequest;
use App\Models\Kegiatan;
use App\Models\User;
use App\Notifications\KegiatanNotification;
use Illuminate\Support\Facades\Notification;

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
        $data = $r->validated();
        if ($r->hasFile('foto')) {
            $data['foto_path'] = $r->file('foto')->store('kegiatan', 'public');
        }
        unset($data['foto']);
        $k = Kegiatan::create($data);

        // Notifikasi email dinonaktifkan

        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan dibuat');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.form', ['item' => $kegiatan]);
    }

    public function update(UpdateKegiatanRequest $r, Kegiatan $kegiatan)
    {
        $data = $r->validated();
        if ($r->hasFile('foto')) {
            $data['foto_path'] = $r->file('foto')->store('kegiatan', 'public');
        }
        unset($data['foto']);
        $kegiatan->update($data);

        // Notifikasi email dinonaktifkan

        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return back()->with('success','Kegiatan dihapus');
    }

    public function notify(Kegiatan $kegiatan)
    {
        $wali = User::role('wali_santri')->whereNotNull('email')->get();
        if ($wali->isEmpty()) {
            return back()->with('error', 'Tidak ada wali santri dengan email terdaftar.');
        }

        Notification::send($wali, new KegiatanNotification($kegiatan));

        return back()->with('success', 'Notifikasi email dikirim ke wali santri.');
    }
}
