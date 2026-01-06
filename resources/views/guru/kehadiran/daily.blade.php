<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Presensi Harian</div>
                        <div class="text-sm text-zinc-600">Rekap presensi kelas {{ $kelas->nama_kelas }}</div>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 font-semibold hover:bg-zinc-50"
                           href="{{ route('guru.kehadiran.form', [$kelas, 'tanggal' => $tanggal]) }}">
                            Edit Presensi
                        </a>
                        <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 font-semibold hover:bg-zinc-50"
                           href="{{ route('guru.kehadiran.index') }}">
                            Presensi Baru
                        </a>
                    </div>
                </div>

                <div class="p-4 space-y-4">
                    <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-end md:gap-3">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest text-zinc-600">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $tanggal }}" class="mt-1 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                        <div class="flex items-end gap-2">
                            <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                                Lihat Presensi
                            </button>
                        </div>
                    </form>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="px-4 py-3 text-left font-semibold">Nomor Induk</th>
                                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                                    <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($records as $rec)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $rec->santri->no_induk ?? '-' }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-zinc-900">{{ $rec->santri->nama_lengkap ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $labels = ['H'=>'Hadir','I'=>'Izin','S'=>'Sakit','A'=>'Alpa'];
                                                $colors = ['H'=>'bg-green-100 text-green-700','I'=>'bg-yellow-100 text-yellow-700','S'=>'bg-blue-100 text-blue-700','A'=>'bg-red-100 text-red-700'];
                                                $status = $rec->status ?? 'H';
                                            @endphp
                                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $colors[$status] ?? 'bg-zinc-100 text-zinc-700' }}">
                                                {{ $status }} - {{ $labels[$status] ?? '' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-zinc-700">{{ $rec->keterangan ?: '-' }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                                   href="{{ route('guru.kehadiran.form', [$kelas, 'tanggal' => $tanggal]) }}">
                                                    Edit
                                                </a>
                                                <a class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                                   href="{{ route('guru.kelas.show', ['kela' => $kelas->id, 'q' => $rec->santri->nama_lengkap ?? '']) }}">
                                                    Lihat
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-sm text-zinc-500">Belum ada presensi pada tanggal ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
