<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Input Nilai - {{ $kelas->nama_kelas }}</div>
                        <div class="text-sm text-zinc-600">Lengkapi skor dan catatan</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Guru' }}</div>
                </div>

                <div class="p-4">
                    <div class="grid gap-3 text-sm text-zinc-700 md:grid-cols-2">
                        <div><span class="uppercase text-xs text-zinc-500">Mata Pelajaran</span><p class="text-base font-semibold text-zinc-900">{{ \App\Models\MataPelajaran::find($mata_pelajaran_id)?->nama }}</p></div>
                        <div><span class="uppercase text-xs text-zinc-500">Periode Pengajaran</span><p class="text-base font-semibold text-zinc-900">{{ \App\Models\Semester::find($semester_id)?->nama }}</p></div>
                        <div><span class="uppercase text-xs text-zinc-500">Tahun Ajaran</span><p class="text-base font-semibold text-zinc-900">{{ \App\Models\TahunAjaran::find($tahun_ajaran_id)?->nama }}</p></div>
                        <div><span class="uppercase text-xs text-zinc-500">Jenis & Tanggal</span><p class="text-base font-semibold text-zinc-900">{{ $jenis_penilaian }} • {{ $tanggal }}</p></div>
                    </div>

                    <form method="POST" action="{{ route('guru.nilai.store', $kelas) }}" class="mt-6 space-y-6">
                        @csrf
                        <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran_id }}">
                        <input type="hidden" name="semester_id" value="{{ $semester_id }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}">
                        <input type="hidden" name="jenis_penilaian" value="{{ $jenis_penilaian }}">
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <div class="rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-800">
                            Penilaian dibagi 4 kategori: Tilawah, Tajwid, Hafalan, dan Adab. Isi angka (0-100) sesuai performa santri. Rata-rata otomatis disimpan sebagai nilai akhir, detail kategori dicatat di catatan.
                        </div>

                        <div class="overflow-hidden rounded-2xl border border-zinc-200">
                            <table class="w-full text-sm">
                                <thead class="bg-zinc-50">
                                    <tr class="border-b border-zinc-200">
                                        <th class="px-4 py-3 text-left font-semibold">Nomor Induk</th>
                                        <th class="px-4 py-3 text-left font-semibold">Nama Santri</th>
                                        <th class="px-4 py-3 text-left font-semibold">Tilawah</th>
                                        <th class="px-4 py-3 text-left font-semibold">Tajwid</th>
                                        <th class="px-4 py-3 text-left font-semibold">Hafalan</th>
                                        <th class="px-4 py-3 text-left font-semibold">Adab</th>
                                        <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($santri as $s)
                                    @php($rec = $existing[$s->id] ?? null)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $s->no_induk }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-semibold text-zinc-900">{{ $s->nama_lengkap }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" step="0.01" min="0" max="100" name="tilawah[{{ $s->id }}]" value="{{ $rec->skor ?? '' }}" class="w-24 rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="0-100">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" step="0.01" min="0" max="100" name="tajwid[{{ $s->id }}]" value="" class="w-24 rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="0-100">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" step="0.01" min="0" max="100" name="hafalan[{{ $s->id }}]" value="" class="w-24 rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="0-100">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" step="0.01" min="0" max="100" name="adab[{{ $s->id }}]" value="" class="w-24 rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="0-100">
                                        </td>
                                        <td class="px-4 py-3">
                                            <input name="catatan[{{ $s->id }}]" value="{{ $rec->catatan ?? '' }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="Catatan opsional">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                                Simpan Nilai
                            </button>
                            <a href="{{ route('guru.nilai.index') }}" class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
