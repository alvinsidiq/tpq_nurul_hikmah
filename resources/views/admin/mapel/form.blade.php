<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Mata Pelajaran</h2></x-slot>
    <div class="p-6 max-w-2xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.mapel.update',$item) : route('admin.mapel.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Kode</label>
                <input name="kode" value="{{ old('kode',$item->kode) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input name="nama" value="{{ old('nama',$item->nama) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Level ID</label>
                <input type="number" min="0" name="level_id" value="{{ old('level_id',$item->level_id) }}" class="mt-1 border p-2 w-full rounded">
            </div>
            <div>
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.mapel.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
