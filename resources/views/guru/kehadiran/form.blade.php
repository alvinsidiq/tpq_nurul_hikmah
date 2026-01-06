<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Presensi Kelas: {{ $kelas->nama_kelas }}</div>
                        <div class="text-sm text-zinc-600">Tanggal presensi dan status santri</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Guru' }}</div>
                </div>

                <form method="POST" action="{{ route('guru.kehadiran.store', $kelas) }}" class="p-4 space-y-6">
                    @csrf
                    @if($isLockedDate ?? false)
                        <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                            Presensi untuk tanggal ini sudah tersimpan. Anda sedang mengedit data. Tanggal dikunci.
                        </div>
                    @endif
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Tanggal Presensi</label>
                            <input type="date" name="tanggal" value="{{ $tanggal }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" {{ ($isLockedDate ?? false) ? 'readonly aria-readonly=true' : '' }} required>
                        </div>
                        <p class="text-sm text-zinc-600">H=Hadir • I=Izin • S=Sakit • A=Alpa</p>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="px-4 py-3 text-left font-semibold">Nomor Induk</th>
                                    <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($santri as $s)
                                @php($rec = $existing[$s->santri_id ?? $s->id] ?? null)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">{{ $s->no_induk }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium">{{ $s->nama_lengkap }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <select name="statuses[{{ $s->id }}]" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                                            @foreach(['H'=>'Hadir','I'=>'Izin','S'=>'Sakit','A'=>'Alpa'] as $k=>$v)
                                                <option value="{{ $k }}" @selected(($rec->status ?? 'H')===$k)>{{ $k }} - {{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input name="keterangan[{{ $s->id }}]" value="{{ $rec->keterangan ?? '' }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" placeholder="Catatan opsional">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            Simpan Presensi
                        </button>
                        <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50" href="{{ route('guru.kehadiran.daily', [$kelas, 'tanggal' => $tanggal]) }}">
                            Lihat Presensi Harian
                        </a>
                        <a class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50" href="{{ route('guru.kehadiran.index') }}">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
