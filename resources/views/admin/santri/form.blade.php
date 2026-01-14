<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
        $isEdit = $item->exists;
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Santri' : 'Tambah Santri' }}</div>
                        <div class="text-sm text-zinc-600">{{ $isEdit ? $item->nama_lengkap : 'Lengkapi data santri' }}</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.santri.update', $item) : route('admin.santri.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Nomor Induk Santri</label>
                            <input name="no_induk" value="{{ old('no_induk', $item->no_induk) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Nama Lengkap</label>
                            <input name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $item->tgl_lahir) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Jilid</label>
                            <select name="jilid_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($jilids as $id => $nama)
                                    <option value="{{ $id }}" @selected(old('jilid_id', $item->jilid_id) == $id)>{{ $nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">{{ old('alamat', $item->alamat) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Kelas</label>
                            <select name="kelas_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                                <option value="">-- Belum ditempatkan --</option>
                                @foreach($kelas as $id=>$name)
                                    <option value="{{ $id }}" @selected(old('kelas_id', $item->kelas_id)==$id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Wali Santri (User)</label>
                            <select name="wali_user_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($walis as $id=>$name)
                                    <option value="{{ $id }}" @selected(old('wali_user_id', $item->wali_user_id)===$id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        @if($item->foto_path)
                            <img src="{{ asset('storage/'.$item->foto_path) }}" alt="Foto {{ $item->nama_lengkap }}" class="mt-2 h-16 w-16 rounded-2xl object-cover">
                        @endif
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.santri.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
