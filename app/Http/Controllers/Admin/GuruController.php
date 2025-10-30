<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGuruRequest;
use App\Http\Requests\Admin\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index()
    {
        $items = Guru::with('user')->paginate(12);
        return view('admin.guru.index', compact('items'));
    }

    public function create()
    {
        return view('admin.guru.form', ['item' => new Guru()]);
    }

    public function store(StoreGuruRequest $r)
    {
        $data = $r->validated();
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['nama_lengkap'],
                'password' => Hash::make(Str::password(10)),
                'status' => 'active',
            ]
        );
        $user->assignRole('guru');

        Guru::create([
            'user_id' => $user->id,
            'nama_lengkap' => $data['nama_lengkap'],
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru dibuat');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.form', ['item' => $guru]);
    }

    public function update(UpdateGuruRequest $r, Guru $guru)
    {
        $data = $r->validated();
        $guru->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'no_telepon' => $data['no_telepon'] ?? null,
            'alamat' => $data['alamat'] ?? null,
        ]);
        // Optionally update linked user's name/email
        $guru->user->update([
            'name' => $data['nama_lengkap'],
            'email' => $data['email'],
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru diperbarui');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return back()->with('success', 'Guru dihapus');
    }
}
