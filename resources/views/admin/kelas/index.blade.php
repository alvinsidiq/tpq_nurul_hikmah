<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Data Kelas</div>
                        <div class="text-sm text-zinc-600">Total {{ $items->total() }} kelas terdaftar</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-zinc-600">
                            Kelola kapasitas, wali kelas (opsional), jilid, dan pengajar mapel melalui jadwal.
                        </div>
                        <a href="{{ route('admin.kelas.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            + Tambah Kelas
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="w-[220px] px-4 py-3 text-left font-semibold">Nama Kelas</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Wali Kelas (Opsional)</th>
                                    <th class="w-[160px] px-4 py-3 text-left font-semibold">Pengajar Mapel</th>
                                    <th class="w-[140px] px-4 py-3 text-left font-semibold">Kapasitas</th>
                                    <th class="w-[140px] px-4 py-3 text-left font-semibold">Jilid</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $i)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3 align-top">
                                            <div class="font-semibold text-zinc-900">{{ $i->nama_kelas }}</div>
                                            <div class="text-xs text-zinc-500">Kode: {{ $i->kode ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="text-sm font-medium text-zinc-800">{{ $i->waliKelas?->name ?? '-' }}</div>
                                            <div class="text-xs text-zinc-500">{{ $i->waliKelas?->phone ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="text-sm font-medium text-zinc-800">{{ $i->pengajar_count ?? 0 }} Guru</div>
                                            <a href="{{ route('admin.jadwal.index') }}" class="text-xs text-zinc-500 hover:text-zinc-700">Atur di Jadwal</a>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                                {{ $i->kapasitas }} Santri
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">
                                                {{ $i->jilid?->nama ?? $i->level_jilid ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('admin.kelas.edit',$i) }}"
                                                    class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.kelas.destroy',$i) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-xl border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data kelas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
