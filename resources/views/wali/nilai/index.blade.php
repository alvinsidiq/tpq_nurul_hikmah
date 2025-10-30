<x-app-layout>
    <x-slot name="header"><h2>Nilai Anak</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end mb-4">
            <div>
                <label class="block text-sm">Anak</label>
                <select name="santri_id" class="border p-2 w-full">
                    <option value="">Semua</option>
                    @foreach($anak as $s)
                        <option value="{{ $s->id }}" @selected(($selected['santri_id'] ?? '')==$s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Mata Pelajaran</label>
                <select name="mata_pelajaran_id" class="border p-2 w-full">
                    <option value="">Semua</option>
                    @foreach($mapels as $id=>$nama)
                        <option value="{{ $id }}" @selected(($selected['mata_pelajaran_id'] ?? '')==$id)>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Semester</label>
                <select name="semester_id" class="border p-2 w-full">
                    <option value="">Semua</option>
                    @foreach($semesters as $id=>$nama)
                        <option value="{{ $id }}" @selected(($selected['semester_id'] ?? '')==$id)>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Tahun Ajaran</label>
                <select name="tahun_ajaran_id" class="border p-2 w-full">
                    <option value="">Semua</option>
                    @foreach($tahunAjarans as $id=>$nama)
                        <option value="{{ $id }}" @selected(($selected['tahun_ajaran_id'] ?? '')==$id)>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Terapkan</button>
                <a href="{{ route('wali.nilai.index') }}" class="ml-2 underline">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px]">
                <thead>
                    <tr><th class="text-left p-2">Tanggal</th><th class="text-left p-2">Anak</th><th class="text-left p-2">Mapel</th><th class="text-left p-2">Semester/TA</th><th class="text-left p-2">Jenis</th><th class="text-left p-2">Skor</th><th class="text-left p-2">Catatan</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $n)
                        <tr class="border-t">
                            <td class="p-2">{{ $n->tanggal }}</td>
                            <td class="p-2">{{ $n->santri?->nama_lengkap ?? '-' }}</td>
                            <td class="p-2">{{ $n->mapel?->nama ?? '-' }}</td>
                            <td class="p-2">{{ $n->semester?->nama ?? '-' }} / {{ $n->tahunAjaran?->nama ?? '-' }}</td>
                            <td class="p-2">{{ $n->jenis_penilaian }}</td>
                            <td class="p-2">{{ $n->skor }}</td>
                            <td class="p-2">{{ $n->catatan }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-gray-500 p-4">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $items->links() }}</div>
    </div>
</x-app-layout>

