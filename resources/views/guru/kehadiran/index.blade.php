<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-3xl p-6 space-y-4">
            <x-flash/>

            @php($firstKelasId = $kelas->keys()->first())
            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Kehadiran</div>
                        <div class="text-sm text-zinc-600">Lihat riwayat presensi atau tambahkan presensi baru</div>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-zinc-600">
                        <span>Halo, {{ auth()->user()->name ?? 'Guru' }}</span>
                        @if($firstKelasId)
                            <a href="{{ route('guru.kehadiran.form', [$firstKelasId, 'tanggal' => $tanggal]) }}"
                               class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-zinc-800">
                                Tambah Presensi
                            </a>
                        @else
                            <span class="inline-flex items-center rounded-xl bg-zinc-100 px-3 py-1.5 text-xs font-semibold text-zinc-500">Belum ada kelas</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Riwayat Presensi</div>
                        <div class="text-sm text-zinc-600">Daftar presensi yang sudah tersimpan</div>
                    </div>
                </div>

                <div class="p-4 overflow-hidden rounded-2xl">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-4 py-3 text-left font-semibold">Total Presensi</th>
                                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($rekap ?? collect()) as $row)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3 font-semibold text-zinc-900">{{ \Illuminate\Support\Carbon::parse($row->tgl)->translatedFormat('d M Y') }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $row->nama_kelas ?? 'Kelas' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $row->total }} entri</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <a class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                               href="{{ route('guru.kehadiran.daily', [$row->kelas_id, 'tanggal' => $row->tgl]) }}">
                                                Lihat
                                            </a>
                                            <a class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                               href="{{ route('guru.kehadiran.form', [$row->kelas_id, 'tanggal' => $row->tgl]) }}">
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-sm text-zinc-500">Belum ada presensi tersimpan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($rekap))
                    <div class="px-4 pb-4">
                        {{ $rekap->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
