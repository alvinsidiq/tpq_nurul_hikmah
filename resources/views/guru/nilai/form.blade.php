<x-app-layout>
    <x-slot name="header"><h2>Input Nilai - {{ $kelas->nama_kelas }}</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <div class="mb-4 text-sm text-gray-600">
            <span>Mapel: </span><strong>{{ \App\Models\MataPelajaran::find($mata_pelajaran_id)?->nama }}</strong>
            <span class="ml-3">Semester: </span><strong>{{ \App\Models\Semester::find($semester_id)?->nama }}</strong>
            <span class="ml-3">TA: </span><strong>{{ \App\Models\TahunAjaran::find($tahun_ajaran_id)?->nama }}</strong>
            <span class="ml-3">Jenis: </span><strong>{{ $jenis_penilaian }}</strong>
            <span class="ml-3">Tanggal: </span><strong>{{ $tanggal }}</strong>
        </div>
        <form method="POST" action="{{ route('guru.nilai.store', $kelas) }}" class="space-y-4">
            @csrf
            <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran_id }}">
            <input type="hidden" name="semester_id" value="{{ $semester_id }}">
            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}">
            <input type="hidden" name="jenis_penilaian" value="{{ $jenis_penilaian }}">
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px]">
                    <thead>
                        <tr>
                            <th class="text-left p-2">NIS</th>
                            <th class="text-left p-2">Nama</th>
                            <th class="text-left p-2">Skor</th>
                            <th class="text-left p-2">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($santri as $s)
                        @php($rec = $existing[$s->id] ?? null)
                        <tr class="border-t">
                            <td class="p-2">{{ $s->nis }}</td>
                            <td class="p-2">{{ $s->nama_lengkap }}</td>
                            <td class="p-2"><input type="number" step="0.01" min="0" name="skors[{{ $s->id }}]" value="{{ $rec->skor ?? '' }}" class="border p-2 w-28"></td>
                            <td class="p-2"><input name="catatan[{{ $s->id }}]" value="{{ $rec->catatan ?? '' }}" class="border p-2 w-full" placeholder="Opsional"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Nilai</button>
                <a href="{{ route('guru.nilai.index') }}" class="ml-2 underline">Kembali</a>
            </div>
        </form>
    </div>
</x-app-layout>

