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
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Kelas' : 'Tambah Kelas' }}</div>
                        <div class="text-sm text-zinc-600">{{ $isEdit ? $item->nama_kelas : 'Lengkapi data kelas' }}</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" action="{{ $isEdit ? route('admin.kelas.update', $item) : route('admin.kelas.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Nama Kelas</label>
                        <input name="nama_kelas" value="{{ old('nama_kelas', $item->nama_kelas) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Wali Kelas (Guru)</label>
                        <select name="guru_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                            <option value="">-- Pilih --</option>
                            @foreach($gurus as $id=>$name)
                                <option value="{{ $id }}" @selected(old('guru_id', $item->guru_id)==$id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Kapasitas</label>
                            <input type="number" min="1" max="100" name="kapasitas" value="{{ old('kapasitas', $item->kapasitas ?? 30) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Level Jilid</label>
                            <input type="number" min="0" max="50" name="level_jilid" value="{{ old('level_jilid', $item->level_jilid) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.kelas.index') }}"
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
