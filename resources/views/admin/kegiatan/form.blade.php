<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Kegiatan</h2></x-slot>
    <div class="p-6 max-w-2xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.kegiatan.update',$item) : route('admin.kegiatan.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input name="nama" value="{{ old('nama',$item->nama) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal',$item->tanggal) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input name="lokasi" value="{{ old('lokasi',$item->lokasi) }}" class="mt-1 border p-2 w-full rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" class="mt-1 border p-2 w-full rounded" rows="4">{{ old('deskripsi',$item->deskripsi) }}</textarea>
            </div>
            <!-- Notifikasi email dinonaktifkan -->
            <div>
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.kegiatan.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
