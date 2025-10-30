<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Jadwal</h2></x-slot>
    <div class="p-6 max-w-3xl mx-auto">
        <x-flash/>
        <form method="POST" action="{{ $item->exists ? route('admin.jadwal.update',$item) : route('admin.jadwal.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" class="mt-1 border p-2 w-full rounded" required>
                        @foreach($kelas as $id=>$name)
                            <option value="{{ $id }}" @selected(old('kelas_id',$item->kelas_id)==$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="mt-1 border p-2 w-full rounded" required>
                        @foreach($mapel as $id=>$name)
                            <option value="{{ $id }}" @selected(old('mata_pelajaran_id',$item->mata_pelajaran_id)==$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Guru</label>
                    <select name="guru_id" class="mt-1 border p-2 w-full rounded" required>
                        @foreach($gurus as $id=>$name)
                            <option value="{{ $id }}" @selected(old('guru_id',$item->guru_id)==$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Hari</label>
                    <select name="hari" class="mt-1 border p-2 w-full rounded" required>
                        @foreach($hari as $h)
                            <option value="{{ $h }}" @selected(old('hari',$item->hari)===$h)>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai',$item->jam_mulai) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai',$item->jam_selesai) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
            </div>
            <div>
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.jadwal.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
