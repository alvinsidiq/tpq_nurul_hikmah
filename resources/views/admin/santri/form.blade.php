<x-app-layout>
    <x-slot name="header"><h2>{{ $item->exists ? 'Edit' : 'Tambah' }} Santri</h2></x-slot>
    <div class="p-6 max-w-3xl mx-auto">
        <x-flash/>
        <form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.santri.update',$item) : route('admin.santri.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf @if($item->exists) @method('PUT') @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIS</label>
                    <input name="nis" value="{{ old('nis',$item->nis) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input name="nama_lengkap" value="{{ old('nama_lengkap',$item->nama_lengkap) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir',$item->tgl_lahir) }}" class="mt-1 border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jilid Level</label>
                    <input type="number" min="0" max="50" name="jilid_level" value="{{ old('jilid_level',$item->jilid_level ?? 0) }}" class="mt-1 border p-2 w-full rounded" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="mt-1 border p-2 w-full rounded" rows="3">{{ old('alamat',$item->alamat) }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select name="kelas_id" class="mt-1 border p-2 w-full rounded">
                        <option value="">-- Belum ditempatkan --</option>
                        @foreach($kelas as $id=>$name)
                            <option value="{{ $id }}" @selected(old('kelas_id',$item->kelas_id)==$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Wali Santri (User)</label>
                    <select name="wali_user_id" class="mt-1 border p-2 w-full rounded" required>
                        @foreach($walis as $id=>$name)
                            <option value="{{ $id }}" @selected(old('wali_user_id',$item->wali_user_id)===$id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" accept="image/*" class="mt-1 border p-2 w-full rounded">
                @if($item->foto_path)
                    <img src="{{ asset('storage/'.$item->foto_path) }}" alt="foto" class="h-16 w-16 object-cover rounded mt-2">
                @endif
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                <a href="{{ route('admin.santri.index') }}" class="ml-2 text-indigo-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
