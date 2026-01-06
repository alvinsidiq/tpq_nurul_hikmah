<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Kehadiran Anak</div>
                        <div class="text-sm text-zinc-600">Data kehadiran hanya untuk anak yang terdaftar pada akun ini.</div>
                        @if($anak->count() > 0)
                            <div class="mt-1 text-sm text-zinc-800 font-semibold">{{ $anak->first()->nama_lengkap }}</div>
                        @endif
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Wali' }}</div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm space-y-3">
                <p class="text-sm font-semibold text-zinc-800">Ringkasan Kehadiran</p>
                <div class="flex flex-wrap gap-2 text-xs">
                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 font-semibold">Hadir: {{ $ringkasan['hadir'] }}</span>
                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 font-semibold">Izin: {{ $ringkasan['izin'] }}</span>
                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 font-semibold">Sakit: {{ $ringkasan['sakit'] }}</span>
                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 font-semibold">Alpa: {{ $ringkasan['alpa'] }}</span>
                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 font-semibold">Persentase: {{ $ringkasan['persentase'] }}%</span>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="overflow-hidden rounded-2xl border border-zinc-200 m-4">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Anak</th>
                                <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $h)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3">{{ $h->tanggal }}</td>
                                    <td class="px-4 py-3">{{ $h->santri?->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $h->kelas?->nama_kelas ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $h->status }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-zinc-700">{{ $h->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data.</td>
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
