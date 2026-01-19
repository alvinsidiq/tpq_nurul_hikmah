<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Mata Pelajaran Saya</div>
                        <div class="text-sm text-zinc-600">Daftar mapel dan kelas yang Anda ajar.</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Guru' }}</div>
                </div>

                <div class="p-4">
                    <div class="rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-700">
                        Guru pengajar mapel ditentukan oleh jadwal. Wali kelas bersifat opsional.
                    </div>
                </div>

                <div class="p-4 pt-0 overflow-hidden rounded-2xl">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Mapel</th>
                                <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-4 py-3 text-left font-semibold">Jadwal</th>
                                <th class="px-4 py-3 text-left font-semibold">Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($userId = auth()->id())
                            @forelse($jadwals as $jadwal)
                                @php($isWali = (int) ($jadwal->kelas?->guru_id ?? 0) === (int) $userId)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3 text-zinc-900 font-semibold">{{ $jadwal->mapel?->nama ?? '-' }}</td>
                                    <td class="px-4 py-3 text-zinc-800">{{ $jadwal->kelas?->nama_kelas ?? '-' }}</td>
                                    <td class="px-4 py-3 text-zinc-800">
                                        {{ $jadwal->hari }} • {{ $jadwal->jam_mulai }}-{{ $jadwal->jam_selesai }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                            {{ $isWali ? 'Wali Kelas' : 'Guru Pengajar' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-sm text-zinc-500">
                                        Belum ada jadwal mengajar. Hubungi admin untuk mengatur jadwal.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
