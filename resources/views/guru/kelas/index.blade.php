<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4">
                    <div class="text-lg font-semibold">Kelas Saya</div>
                    <div class="text-sm text-zinc-600">Kelas yang Anda ampu</div>
                </div>
                <div class="overflow-hidden rounded-2xl border border-zinc-200 m-4">
                    <table class="w-full text-sm">
                        <thead class="bg-zinc-50">
                            <tr class="border-b border-zinc-200">
                                <th class="px-4 py-3 text-left font-semibold">Nama Kelas</th>
                                <th class="px-4 py-3 text-left font-semibold">Kapasitas</th>
                                <th class="px-4 py-3 text-left font-semibold">Jilid</th>
                                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $i)
                                <tr class="border-b border-zinc-200 last:border-b-0">
                                    <td class="px-4 py-3 text-base font-semibold text-zinc-900">{{ $i->nama_kelas }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                            {{ $i->kapasitas }} Santri
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                            {{ $i->jilid?->nama ?? $i->level_jilid ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('guru.kelas.show',$i) }}"
                                                class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                Lihat Santri
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada kelas yang diampu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-4 pb-4 flex justify-end">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
