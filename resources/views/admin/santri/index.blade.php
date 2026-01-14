<x-app-layout>
    <x-slot name="header"><h2>Data Santri</h2></x-slot>

    <div class="min-h-screen bg-white py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-4">
            <x-flash/>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-indigo-500 font-semibold">Database Santri</p>
                    <p class="text-3xl font-bold text-gray-900">Total {{ $items->total() }} Santri Terdaftar</p>
                    <p class="text-sm text-gray-500 mt-1">Pantau profil santri, wali, dan progres jilid.</p>
                </div>
                <a href="{{ route('admin.santri.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                    Tambah Santri
                </a>
            </div>

            <div class="rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[960px] table-auto text-sm text-gray-700">
                        <thead>
                            <tr class="bg-zinc-50 text-zinc-900">
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Nomor Induk</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Profil</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Kelas</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Wali</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Jilid</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Foto</th>
                                <th class="px-6 py-4 text-left text-[0.75rem] font-semibold tracking-[0.2em] uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @forelse($items as $i)
                                <tr class="bg-white hover:bg-zinc-50 transition-colors duration-200">
                                    <td class="px-6 py-5 align-top">
                                        <span class="inline-flex items-center rounded-xl bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm shadow-indigo-50">{{ $i->no_induk }}</span>
                                    </td>
                                    <td class="px-6 py-5 align-top space-y-1">
                                        <p class="text-base font-semibold text-gray-900 tracking-tight">{{ $i->nama_lengkap }}</p>
                                        <p class="text-xs text-gray-500">{{ $i->jenis_kelamin ?? 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <p class="text-sm font-medium text-gray-900">{{ $i->kelas?->nama_kelas ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">Jilid: {{ $i->kelas?->jilid?->nama ?? $i->kelas?->level_jilid ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-5 align-top space-y-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $i->wali?->name ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ $i->wali?->email ?? '' }}</p>
                                        <p class="text-xs text-gray-500">{{ $i->wali?->phone ?? '' }}</p>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">
                                            {{ $i->jilid?->nama ?? $i->jilid_level ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        @if($i->foto_path)
                                            <img src="{{ asset('storage/'.$i->foto_path) }}" alt="Foto {{ $i->nama_lengkap }}" class="h-16 w-16 rounded-2xl object-cover shadow">
                                        @else
                                            <div class="h-16 w-16 rounded-2xl bg-gray-100 flex items-center justify-center text-xs text-gray-400">Tidak ada</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 align-top">
                                        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                                            <a href="{{ route('admin.santri.edit',$i) }}"
                                                class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.santri.destroy',$i) }}" method="POST" onsubmit="return confirm('Hapus santri ini?')" class="inline">
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
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">Belum ada data.</td>
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
