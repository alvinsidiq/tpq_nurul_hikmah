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
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Periode Pengajaran' : 'Tambah Periode Pengajaran' }}</div>
                        <div class="text-sm text-zinc-600">{{ $isEdit ? $item->nama : 'Lengkapi data semester/periode' }}</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" action="{{ $isEdit ? route('admin.semesters.update', $item) : route('admin.semesters.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach($tahunAjarans as $ta)
                                <option value="{{ $ta->id }}" @selected(old('tahun_ajaran_id', $item->tahun_ajaran_id) == $ta->id)>
                                    {{ $ta->nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tahun_ajaran_id')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-zinc-800">Nama Semester</label>
                        <input name="nama" value="{{ old('nama', $item->nama) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        <x-input-error :messages="$errors->get('nama')" class="mt-1" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Tgl Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', optional($item->tanggal_mulai)->format('Y-m-d')) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                            <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Tgl Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', optional($item->tanggal_selesai)->format('Y-m-d')) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                            <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="hidden" name="aktif" value="0">
                        <input type="checkbox" name="aktif" value="1" class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900" @checked(old('aktif', $item->aktif))>
                        <label class="text-sm text-zinc-800">Aktifkan periode ini</label>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.semesters.index') }}"
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
