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
                        <div class="text-lg font-semibold">Kegiatan TPQ</div>
                        <div class="text-sm text-zinc-600">Total {{ $items->total() }} kegiatan terjadwal</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-zinc-600">
                            Dokumentasikan seluruh aktivitas belajar dan event penting.
                        </div>
                        <a href="{{ route('admin.kegiatan.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            + Tambah Kegiatan
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="w-[240px] px-4 py-3 text-left font-semibold">Nama</th>
                                    <th class="w-[180px] px-4 py-3 text-left font-semibold">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold">Lokasi</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $i)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                @if($i->foto_path)
                                                    <img src="{{ asset('storage/'.$i->foto_path) }}" alt="Foto {{ $i->nama }}" class="h-10 w-10 rounded-xl object-cover">
                                                @else
                                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-100 text-sm font-semibold text-zinc-600">
                                                        {{ Str::upper(Str::substr($i->nama, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium">{{ $i->nama }}</div>
                                                    <div class="text-xs text-zinc-500">PJ: {{ $i->penanggung_jawab ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                                {{ \Carbon\Carbon::parse($i->tanggal)->translatedFormat('d F Y') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-zinc-800">{{ $i->lokasi }}</div>
                                            <div class="text-xs text-zinc-500">{{ Str::limit($i->deskripsi ?? '', 60) }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.kegiatan.edit', $i) }}"
                                                class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.kegiatan.notify', $i) }}" method="POST" onsubmit="return confirm('Kirim notifikasi email ke semua wali santri?')" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="rounded-xl border border-indigo-200 px-3 py-1.5 text-xs font-semibold text-indigo-700 hover:bg-indigo-50">
                                                    Kirim Notifikasi Email
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.kegiatan.destroy', $i) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
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
                                        <td colspan="4" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data.</td>
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
