<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Kenaikan Jilid</div>
                        <div class="text-sm text-zinc-600">Rekap nilai akhir untuk rekomendasi kenaikan kelas.</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Guru' }}</div>
                </div>

                @php($canFilter = $kelasOptions->isNotEmpty() && $semesterOptions->isNotEmpty() && $tahunAjaranOptions->isNotEmpty())
                <div class="p-4 space-y-4">
                    <div class="rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-700 space-y-1">
                        <div class="font-semibold text-zinc-900">Rumus Perhitungan</div>
                        <div>Nilai akhir mapel dihitung dari bobot:
                            @foreach($jenisPenilaian as $key => $label)
                                <span class="font-semibold">{{ $label }} {{ (int) round(($bobot[$key] ?? 0) * 100) }}%</span>@if(!$loop->last),@endif
                            @endforeach
                        </div>
                        <div>Kenaikan kelas menggunakan rata-rata nilai akhir mapel (ambang {{ $ambangNaik }}).</div>
                    </div>

                    <form method="GET" action="{{ route('guru.kenaikan.index') }}" class="grid gap-4 md:grid-cols-3">
                        <label class="space-y-1 text-sm">
                            <span class="uppercase text-xs text-zinc-500">Kelas</span>
                            <select name="kelas_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canFilter)>
                                @foreach($kelasOptions as $id => $nama)
                                    <option value="{{ $id }}" @selected($kelasId == $id)>{{ $nama }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="space-y-1 text-sm">
                            <span class="uppercase text-xs text-zinc-500">Semester</span>
                            <select name="semester_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canFilter)>
                                @foreach($semesterOptions as $id => $nama)
                                    <option value="{{ $id }}" @selected($semesterId == $id)>{{ $nama }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="space-y-1 text-sm">
                            <span class="uppercase text-xs text-zinc-500">Tahun Ajaran</span>
                            <select name="tahun_ajaran_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canFilter)>
                                @foreach($tahunAjaranOptions as $id => $nama)
                                    <option value="{{ $id }}" @selected($tahunAjaranId == $id)>{{ $nama }}</option>
                                @endforeach
                            </select>
                        </label>
                        <div class="flex items-end">
                            <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800" @disabled(!$canFilter)>
                                Tampilkan Rekap
                            </button>
                        </div>
                        @if(!$canFilter)
                            <div class="md:col-span-3 text-xs text-zinc-500">Data kelas/semester/tahun ajaran belum lengkap.</div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Rekap Kenaikan</div>
                        <div class="text-sm text-zinc-600">Rata-rata nilai akhir per santri berdasarkan mapel di kelas.</div>
                    </div>
                    <div class="text-xs text-zinc-500">Mapel aktif: {{ $mapelCount }}</div>
                </div>

                <div class="p-4 overflow-hidden rounded-2xl">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Nomor Induk</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama Santri</th>
                                <th class="px-4 py-3 text-left font-semibold">Nilai Akhir</th>
                                <th class="px-4 py-3 text-left font-semibold">Kelengkapan Mapel</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekap as $row)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $row['santri']->no_induk ?? '-' }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-zinc-900 font-semibold">{{ $row['santri']->nama_lengkap ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                            {{ $row['nilai_akhir'] !== null ? number_format($row['nilai_akhir'], 2) : '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-zinc-700">{{ $row['mapel_complete'] }}/{{ $row['mapel_total'] }} mapel</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $row['status'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data rekap.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
