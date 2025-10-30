<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Guru</h2></x-slot>
    <div class="p-6 max-w-2xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.guru.update',$item) : route('admin.guru.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input name="nama_lengkap" value="{{ old('nama_lengkap',$item->nama_lengkap) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email',$item->user->email ?? '') }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No Telepon</label>
                <input name="no_telepon" value="{{ old('no_telepon',$item->no_telepon) }}" class="mt-1 border p-2 w-full rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="mt-1 border p-2 w-full rounded" rows="3">{{ old('alamat',$item->alamat) }}</textarea>
            </div>
            <div>
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.guru.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
