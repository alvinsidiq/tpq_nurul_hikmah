<x-app-layout>
    <x-slot name="header"><h2>Mata Pelajaran</h2></x-slot>

    <div class="min-h-screen bg-white py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-4">
            <x-flash/>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-indigo-500 font-semibold">Kurikulum TPQ</p>
                    <p class="text-3xl font-bold text-gray-900">Total {{ $items->total() }} Mata Pelajaran</p>
                    <p class="text-sm text-gray-500 mt-1">Kelola kode mapel dan level jilid untuk mendukung pelaporan.</p>
                </div>
                <a href="{{ route('admin.mapel.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                    Tambah Mata Pelajaran
                </a>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] table-auto text-sm text-gray-700">
                        <thead>
                            <tr class="bg-zinc-50 text-zinc-900">
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Kode</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Nama</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Level</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @forelse($items as $i)
                                <tr class="bg-white hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 align-top">
                                        <span class="inline-flex items-center rounded-xl bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm shadow-indigo-50">
                                            {{ $i->kode }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <p class="text-base font-semibold text-gray-900 tracking-tight">{{ $i->nama }}</p>
                                        <p class="text-xs text-gray-500">Kategori: {{ $i->kategori ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <p class="text-sm font-medium text-gray-900">{{ $i->level_id ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">Jilid</p>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                                            <a href="{{ route('admin.mapel.edit',$i) }}"
                                                class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.mapel.destroy',$i) }}" method="POST" onsubmit="return confirm('Hapus mata pelajaran ini?')" class="inline">
                                                @csrf @method('DELETE')
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
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
