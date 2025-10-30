<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Tahun Ajaran</h2></x-slot>
    <div class="p-6 max-w-2xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.ta.update',$item) : route('admin.ta.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input name="nama" value="{{ old('nama',$item->nama) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tgl Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai',$item->tanggal_mulai) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tgl Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai',$item->tanggal_selesai) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div class="flex items-center space-x-2">
                <input type="hidden" name="aktif" value="0">
                <input type="checkbox" name="aktif" value="1" class="rounded" @checked(old('aktif',$item->aktif))>
                <label class="text-sm text-gray-700">Aktif</label>
            </div>
            <div>
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.ta.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
