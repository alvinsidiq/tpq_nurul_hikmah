<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Kelas</h2></x-slot>
    <div class="p-6 max-w-2xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.kelas.update',$item) : route('admin.kelas.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                <input name="nama_kelas" value="{{ old('nama_kelas',$item->nama_kelas) }}" class="mt-1 border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Wali Kelas (Guru)</label>
                <select name="guru_id" class="mt-1 border p-2 w-full rounded">
                    <option value="">-- Pilih --</option>
                    @foreach($gurus as $id=>$name)
                        <option value="{{ $id }}" @selected(old('guru_id',$item->guru_id)==$id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="number" min="1" max="100" name="kapasitas" value="{{ old('kapasitas',$item->kapasitas ?? 30) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Level Jilid</label>
                    <input type="number" min="0" max="50" name="level_jilid" value="{{ old('level_jilid',$item->level_jilid) }}" class="mt-1 border p-2 w-full rounded">
                </div>
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.kelas.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
    
</x-app-layout>
