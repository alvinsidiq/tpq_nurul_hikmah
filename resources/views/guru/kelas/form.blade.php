<x-app-layout>
    <x-slot name="header"><h2>Edit Kelas</h2></x-slot>
    <div class="p-6 max-w-3xl">
        <x-flash/>
        <form method="POST" action="{{ route('guru.kelas.update',$item) }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block">Nama Kelas</label>
                <input value="{{ $item->nama_kelas }}" class="border p-2 w-full bg-gray-100" disabled>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block">Kapasitas</label>
                    <input type="number" name="kapasitas" min="1" max="100" value="{{ old('kapasitas',$item->kapasitas) }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="block">Level Jilid</label>
                    <input type="number" name="level_jilid" min="0" max="50" value="{{ old('level_jilid',$item->level_jilid) }}" class="border p-2 w-full">
                </div>
            </div>
            <div>
                <label class="block">Deskripsi</label>
                <textarea name="deskripsi" class="border p-2 w-full" rows="5">{{ old('deskripsi',$item->deskripsi) }}</textarea>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                <a href="{{ route('guru.kelas.index') }}" class="ml-2 underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>

