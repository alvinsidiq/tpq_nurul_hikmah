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
                        <div class="text-lg font-semibold">Data Guru</div>
                        <div class="text-sm text-zinc-600">Total {{ $items->count() }} guru terdaftar</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-zinc-600">
                            Kelola data guru dan aksesnya dalam satu tempat.
                        </div>
                        <a href="{{ route('admin.guru.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            + Tambah Guru
                        </a>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="w-[240px] px-4 py-3 text-left font-semibold">Nama Lengkap</th>
                                    <th class="w-[220px] px-4 py-3 text-left font-semibold">Email</th>
                                    <th class="w-[180px] px-4 py-3 text-left font-semibold">Telepon</th>
                                    <th class="px-4 py-3 text-left font-semibold">Alamat</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $i)
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3">
                                            <div class="font-medium">{{ $i->nama_lengkap }}</div>
                                            <div class="text-xs text-zinc-500">ID: {{ $i->id }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-zinc-800">{{ $i->user?->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                                {{ $i->no_telepon ?? 'Belum diatur' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-zinc-700">{{ $i->alamat ? Str::limit($i->alamat, 80) : '-' }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('admin.guru.edit', $i) }}"
                                                    class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.guru.destroy', $i) }}" method="POST" onsubmit="return confirm('Hapus guru ini?')" class="inline">
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
                                        <td colspan="5" class="px-4 py-10 text-center text-sm text-zinc-500">Belum ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
