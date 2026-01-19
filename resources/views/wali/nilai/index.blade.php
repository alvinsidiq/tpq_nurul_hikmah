<x-app-layout>
    @php($jenisLabels = \App\Models\Nilai::jenisPenilaianLabels())
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Nilai Anak</div>
                        <div class="text-sm text-zinc-600">Anda hanya melihat nilai milik anak terdaftar.</div>
                        @if($anak->count() > 0)
                            <div class="mt-1 text-sm text-zinc-800 font-semibold">{{ $anak->first()->nama_lengkap }}</div>
                        @endif
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Wali' }}</div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="overflow-hidden rounded-2xl border border-zinc-200 m-4">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Anak</th>
                                <th class="px-4 py-3 text-left font-semibold">Mapel</th>
                                <th class="px-4 py-3 text-left font-semibold">Periode Pengajaran / TA</th>
                                <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                                <th class="px-4 py-3 text-left font-semibold">Skor</th>
                                <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $n)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3">{{ $n->tanggal }}</td>
                                    <td class="px-4 py-3">{{ $n->santri?->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $n->mapel?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $n->semester?->nama ?? '-' }} / {{ $n->tahunAjaran?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $jenisLabels[$n->jenis_penilaian] ?? $n->jenis_penilaian }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $n->skor }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-zinc-700">{{ $n->catatan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 pb-4 flex justify-end">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
