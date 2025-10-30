<x-app-layout>
    <x-slot name="header"><h2>Kehadiran Anak</h2></x-slot>
    <div class="p-6">
        <x-flash/>
        <form method="GET" class="flex flex-wrap items-end gap-3 mb-4">
            <div>
                <label class="block text-sm">Anak</label>
                <select name="santri_id" class="border p-2">
                    <option value="">Semua</option>
                    @foreach($anak as $s)
                        <option value="{{ $s->id }}" @selected(($santriId ?? '')==$s->id)>{{ $s->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Bulan</label>
                <input type="month" name="bulan" value="{{ $bulan }}" class="border p-2">
            </div>
            <div class="self-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Terapkan</button>
                <a href="{{ route('wali.kehadiran.index') }}" class="underline ml-2">Reset</a>
            </div>
        </form>

        <div class="mb-4">
            <span class="inline-block px-3 py-1 rounded bg-green-100 text-green-800">Hadir: {{ $ringkasan['hadir'] }}</span>
            <span class="inline-block px-3 py-1 rounded bg-amber-100 text-amber-800 ml-2">Izin: {{ $ringkasan['izin'] }}</span>
            <span class="inline-block px-3 py-1 rounded bg-yellow-100 text-yellow-800 ml-2">Sakit: {{ $ringkasan['sakit'] }}</span>
            <span class="inline-block px-3 py-1 rounded bg-red-100 text-red-800 ml-2">Alpa: {{ $ringkasan['alpa'] }}</span>
            <span class="inline-block px-3 py-1 rounded bg-blue-100 text-blue-800 ml-2">Persentase Hadir: {{ $ringkasan['persentase'] }}%</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px]">
                <thead>
                    <tr><th class="text-left p-2">Tanggal</th><th class="text-left p-2">Anak</th><th class="text-left p-2">Kelas</th><th class="text-left p-2">Status</th><th class="text-left p-2">Keterangan</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $h)
                        <tr class="border-t">
                            <td class="p-2">{{ $h->tanggal }}</td>
                            <td class="p-2">{{ $h->santri?->nama_lengkap ?? '-' }}</td>
                            <td class="p-2">{{ $h->kelas?->nama_kelas ?? '-' }}</td>
                            <td class="p-2">{{ $h->status }}</td>
                            <td class="p-2">{{ $h->keterangan }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-gray-500 p-4">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $items->links() }}</div>
    </div>
</x-app-layout>

