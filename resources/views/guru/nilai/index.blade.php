<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Mulai Penilaian</div>
                        <div class="text-sm text-zinc-600">Nilai hanya dapat diisi oleh guru mapel yang mengampu.</div>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-zinc-600">
                        <span>Halo, {{ auth()->user()->name ?? 'Guru' }}</span>
                    </div>
                </div>
                @php
                    $canStart = $jadwals->isNotEmpty() && $semesters->isNotEmpty() && $tahunAjarans->isNotEmpty() && !empty($jenisPenilaian);
                    $firstJadwal = $jadwals->first();
                    $firstJenis = collect($jenisPenilaian)->keys()->first();
                @endphp
                <div class="border-t border-zinc-200 p-4 space-y-4">
                    <form method="GET" action="{{ route('guru.nilai.start') }}" class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-2">
                            <label class="space-y-1 text-sm">
                                <span class="uppercase text-xs text-zinc-500">Jadwal Mengajar</span>
                                <select name="jadwal_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canStart)>
                                    @forelse($jadwals as $jadwal)
                                        <option value="{{ $jadwal->id }}" @selected(old('jadwal_id', $firstJadwal?->id) == $jadwal->id)>
                                            {{ $jadwal->kelas?->nama_kelas ?? '-' }} • {{ $jadwal->mapel?->nama ?? '-' }} ({{ $jadwal->hari }} {{ $jadwal->jam_mulai }}-{{ $jadwal->jam_selesai }})
                                        </option>
                                    @empty
                                        <option value="">Belum ada jadwal mengajar</option>
                                    @endforelse
                                </select>
                            </label>
                            <label class="space-y-1 text-sm">
                                <span class="uppercase text-xs text-zinc-500">Jenis Penilaian</span>
                                <select name="jenis_penilaian" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canStart)>
                                    @foreach($jenisPenilaian as $key => $label)
                                        <option value="{{ $key }}" @selected(old('jenis_penilaian', $firstJenis) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="space-y-1 text-sm">
                                <span class="uppercase text-xs text-zinc-500">Semester</span>
                                <select name="semester_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canStart)>
                                    @foreach($semesters as $id => $nama)
                                        <option value="{{ $id }}" @selected(old('semester_id', $semesters->keys()->first()) == $id)>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="space-y-1 text-sm">
                                <span class="uppercase text-xs text-zinc-500">Tahun Ajaran</span>
                                <select name="tahun_ajaran_id" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canStart)>
                                    @foreach($tahunAjarans as $id => $nama)
                                        <option value="{{ $id }}" @selected(old('tahun_ajaran_id', $tahunAjarans->keys()->first()) == $id)>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="space-y-1 text-sm">
                                <span class="uppercase text-xs text-zinc-500">Tanggal</span>
                                <input type="date" name="tanggal" value="{{ old('tanggal', $tanggal) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" @disabled(!$canStart)>
                            </label>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800" @disabled(!$canStart)>
                                Lanjut Input Nilai
                            </button>
                            @if(!$canStart)
                                <span class="inline-flex items-center rounded-xl bg-zinc-100 px-3 py-2 text-xs font-semibold text-zinc-500">Data jadwal/semester/tahun ajaran belum lengkap</span>
                            @endif
                        </div>
                    </form>

                    <div class="rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-700 space-y-1">
                        <div class="font-semibold text-zinc-900">Alur Penilaian</div>
                        <div>1. Pilih jadwal mengajar sesuai mapel yang diampu.</div>
                        <div>2. Isi nilai untuk Tugas Mingguan, Tengah Periode, dan Akhir Periode.</div>
                        <div>3. Nilai akhir mapel dihitung dari bobot:
                            @foreach($jenisPenilaian as $key => $label)
                                <span class="font-semibold">{{ $label }} {{ (int) round(($bobot[$key] ?? 0) * 100) }}%</span>@if(!$loop->last),@endif
                            @endforeach
                        </div>
                        <div>4. Kenaikan kelas menggunakan rata-rata nilai akhir mapel (ambang {{ $ambangNaik }}).</div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Riwayat Nilai</div>
                        <div class="text-sm text-zinc-600">Daftar penilaian yang sudah tersimpan</div>
                    </div>
                </div>

                <div class="p-4 overflow-hidden rounded-2xl">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-4 py-3 text-left font-semibold">Mapel</th>
                                <th class="px-4 py-3 text-left font-semibold">Periode Pengajaran / TA</th>
                                <th class="px-4 py-3 text-left font-semibold">Jenis</th>
                                <th class="px-4 py-3 text-left font-semibold">Total</th>
                                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($rekap ?? collect()) as $row)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3 font-semibold text-zinc-900">{{ \Illuminate\Support\Carbon::parse($row->tgl)->translatedFormat('d M Y') }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $row->nama_kelas ?? '-' }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $row->mapel ?? '-' }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ ($row->semester ?? '-') }} / {{ $row->tahun_ajaran ?? '-' }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $jenisLabels[$row->jenis_penilaian] ?? $row->jenis_penilaian }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $row->total }} nilai</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <a class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                               href="{{ route('guru.nilai.form', [
                                                    $row->kelas_id,
                                                    'mata_pelajaran_id'=>$row->mata_pelajaran_id,
                                                    'semester_id'=>$row->semester_id,
                                                    'tahun_ajaran_id'=>$row->tahun_ajaran_id,
                                                    'jenis_penilaian'=>$row->jenis_penilaian,
                                                    'tanggal'=>$row->tgl
                                               ]) }}">
                                                Edit / Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-sm text-zinc-500">Belum ada nilai tersimpan.</td>
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
