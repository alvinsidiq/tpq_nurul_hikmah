<x-app-layout>
    <x-slot name="header"><h2>Detail Kelas</h2></x-slot>
    <div class="p-6 max-w-3xl">
        <div class="space-y-2">
            <div><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</div>
            <div><strong>Kapasitas:</strong> {{ $kelas->kapasitas }}</div>
            <div><strong>Level Jilid:</strong> {{ $kelas->level_jilid }}</div>
            <div><strong>Deskripsi:</strong> <div class="whitespace-pre-line">{{ $kelas->deskripsi }}</div></div>
        </div>
        <div class="mt-4">
            <a class="underline" href="{{ route('guru.kelas.edit',$kelas) }}">Edit</a>
            <a class="underline ml-2" href="{{ route('guru.kelas.index') }}">Kembali</a>
        </div>
    </div>
    <div class="px-6 pb-6">
        <h3 class="text-lg font-semibold mt-6 mb-2">Santri di Kelas Ini</h3>
        <form method="GET" class="flex flex-wrap items-end gap-3 mb-4">
            <div>
                <label class="block text-sm">Cari (Nama/NIS)</label>
                <input name="q" value="{{ $q ?? '' }}" class="border p-2" placeholder="mis. Ahmad / 123"> 
            </div>
            <div>
                <label class="block text-sm">Jilid</label>
                <input type="number" name="jilid_level" min="0" max="50" value="{{ $jilid ?? '' }}" class="border p-2 w-28">
            </div>
            <div class="self-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Terapkan</button>
                <a href="{{ route('guru.kelas.show',$kelas) }}" class="underline ml-2">Reset</a>
            </div>
        </form>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead>
                    <tr><th class="text-left p-2">NIS</th><th class="text-left p-2">Nama</th><th class="text-left p-2">Jilid</th><th class="text-left p-2">Alamat</th></tr>
                </thead>
                <tbody>
                @forelse(($santri ?? collect()) as $s)
                    <tr class="border-t">
                        <td class="p-2">{{ $s->nis }}</td>
                        <td class="p-2">{{ $s->nama_lengkap }}</td>
                        <td class="p-2">{{ $s->jilid_level }}</td>
                        <td class="p-2">{{ Str::limit($s->alamat, 60) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-gray-500 p-4">Tidak ada santri ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($santri))
            <div class="mt-3">{{ $santri->links() }}</div>
        @endif
    </div>
</x-app-layout>
