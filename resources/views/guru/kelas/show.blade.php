<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Detail Kelas</div>
                        <div class="text-sm text-zinc-600">Informasi kelas dan santri</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Guru' }}</div>
                </div>
                <div class="p-4 space-y-4">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-xs uppercase text-zinc-500">Nama Kelas</p>
                            <p class="text-xl font-semibold text-zinc-900">{{ $kelas->nama_kelas }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-zinc-500">Kapasitas</p>
                            <p class="text-xl font-semibold text-zinc-900">{{ $kelas->kapasitas }} Santri</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-zinc-500">Level Jilid</p>
                            <p class="text-xl font-semibold text-zinc-900">{{ $kelas->level_jilid ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-zinc-500">Deskripsi</p>
                            <p class="text-sm text-zinc-700 whitespace-pre-line">{{ $kelas->deskripsi ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a class="rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold hover:bg-zinc-50" href="{{ route('guru.kelas.index') }}">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-3 border-b border-zinc-200 p-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-zinc-800">Santri di Kelas Ini</p>
                        <p class="text-xs text-zinc-600">Daftar santri</p>
                    </div>
                    <form method="GET" class="grid grid-cols-1 gap-3 sm:grid-cols-3 w-full md:w-auto">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Cari</label>
                            <input name="q" value="{{ $q ?? '' }}" class="mt-1 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="Nama / Nomor Induk">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Jilid</label>
                            <input type="number" name="jilid_level" min="0" max="50" value="{{ $jilid ?? '' }}" class="mt-1 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                            <div class="flex items-end gap-2">
                                <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">Terapkan</button>
                                <a href="{{ route('guru.kelas.show', ['kela' => (int) $kelas->id]) }}" class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">Reset</a>
                            </div>
                    </form>
                </div>

                <div class="p-4 overflow-hidden rounded-2xl border border-zinc-200 mx-4 mb-4">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Nomor Induk</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left font-semibold">Jilid</th>
                                <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($santri ?? collect()) as $s)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $s->no_induk }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-zinc-900">{{ $s->nama_lengkap }}</div>
                                        <div class="text-xs text-zinc-500">{{ $s->jenis_kelamin ?? '' }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $s->jilid_level }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-zinc-700">{{ Str::limit($s->alamat, 80) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-zinc-500">Tidak ada santri ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(isset($santri))
                    <div class="px-4 pb-4 flex justify-end">
                        {{ $santri->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
