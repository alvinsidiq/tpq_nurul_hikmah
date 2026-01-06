<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Data Jadwal</div>
                        <div class="text-sm text-zinc-600">Total {{ $items->total() }} jadwal terdaftar</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-zinc-600">Kelola jadwal pengajaran.</div>
                        <a href="{{ route('admin.jadwal.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            + Tambah Jadwal
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="px-4 py-3 text-left font-semibold">Kelas</th>
                                    <th class="px-4 py-3 text-left font-semibold">Mata Pelajaran</th>
                                    <th class="px-4 py-3 text-left font-semibold">Guru</th>
                                    <th class="px-4 py-3 text-left font-semibold">Hari</th>
                                    <th class="px-4 py-3 text-left font-semibold">Jam</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $i)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3 font-medium">{{ $i->kelas?->nama_kelas }}</td>
                                        <td class="px-4 py-3">{{ $i->mapel?->nama }}</td>
                                        <td class="px-4 py-3">{{ $i->guru?->name }}</td>
                                        <td class="px-4 py-3">{{ $i->hari }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                                {{ $i->jam_mulai }} - {{ $i->jam_selesai }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('admin.jadwal.edit', $i) }}"
                                                    class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.jadwal.destroy', $i) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-xl border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-10 text-center text-sm text-zinc-500">
                                            Belum ada data.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
