<x-app-layout>
    <x-slot name="header"><h2>Presensi Kelas: {{ $kelas->nama_kelas }}</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <form method="POST" action="{{ route('guru.kehadiran.store', $kelas) }}" class="space-y-4">
            @csrf
            <div class="flex items-center gap-3">
                <div>
                    <label class="block text-sm">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" class="border p-2" required>
                </div>
                <div class="text-sm text-gray-600">Keterangan status: H (Hadir), I (Izin), S (Sakit), A (Alpa)</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px]">
                    <thead>
                        <tr>
                            <th class="text-left p-2">NIS</th>
                            <th class="text-left p-2">Nama</th>
                            <th class="text-left p-2">Status</th>
                            <th class="text-left p-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($santri as $s)
                        @php($rec = $existing[$s->santri_id ?? $s->id] ?? null)
                        <tr class="border-t">
                            <td class="p-2">{{ $s->nis }}</td>
                            <td class="p-2">{{ $s->nama_lengkap }}</td>
                            <td class="p-2">
                                <select name="statuses[{{ $s->id }}]" class="border p-2">
                                    @foreach(['H'=>'Hadir','I'=>'Izin','S'=>'Sakit','A'=>'Alpa'] as $k=>$v)
                                        <option value="{{ $k }}" @selected(($rec->status ?? 'H')===$k)>{{ $k }} - {{ $v }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-2">
                                <input name="keterangan[{{ $s->id }}]" value="{{ $rec->keterangan ?? '' }}" class="border p-2 w-full" placeholder="Opsional">    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Presensi</button>
                <a class="ml-2 underline" href="{{ route('guru.kehadiran.index') }}">Kembali</a>
            </div>
        </form>
    </div>
</x-app-layout>

