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
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Jadwal' : 'Tambah Jadwal' }}</div>
                        <div class="text-sm text-zinc-600">
                            {{ $isEdit ? ($item->kelas?->nama_kelas ?? 'Jadwal TPQ') : 'Lengkapi form berikut' }}
                        </div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" action="{{ $isEdit ? route('admin.jadwal.update', $item) : route('admin.jadwal.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Kelas</label>
                            <select name="kelas_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($kelas as $id => $name)
                                    <option value="{{ $id }}" @selected(old('kelas_id', $item->kelas_id)==$id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Mata Pelajaran</label>
                            <select name="mata_pelajaran_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($mapel as $id => $name)
                                    <option value="{{ $id }}" @selected(old('mata_pelajaran_id', $item->mata_pelajaran_id)==$id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Guru</label>
                            <select name="guru_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($gurus as $id => $name)
                                    <option value="{{ $id }}" @selected(old('guru_id', $item->guru_id)==$id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Hari</label>
                            <select name="hari" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                @foreach($hari as $h)
                                    <option value="{{ $h }}" @selected(old('hari', $item->hari)===$h)>{{ $h }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Jam Mulai</label>
                            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $item->jam_mulai) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Jam Selesai</label>
                            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $item->jam_selesai) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
