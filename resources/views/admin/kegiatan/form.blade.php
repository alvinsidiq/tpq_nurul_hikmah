<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
        $isEdit = $item->exists;
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-4xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}</div>
                        <div class="text-sm text-zinc-600">{{ $isEdit ? $item->nama : 'Lengkapi data kegiatan' }}</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.kegiatan.update', $item) : route('admin.kegiatan.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Nama</label>
                        <input name="nama" value="{{ old('nama', $item->nama) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Lokasi</label>
                        <input name="lokasi" value="{{ old('lokasi', $item->lokasi) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        @if($item->foto_path)
                            <img src="{{ asset('storage/'.$item->foto_path) }}" alt="Foto {{ $item->nama }}" class="mt-2 h-20 w-20 rounded-2xl object-cover">
                        @endif
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.kegiatan.index') }}"
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
