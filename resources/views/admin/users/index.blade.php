<x-app-layout>
    @php
        $activeMenu = 'Data Pengguna';
        $userName = auth()->user()->name ?? 'Admin';
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-6xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Kelola Data Pengguna</div>
                        <div class="text-sm text-zinc-600">Total {{ $users->total() }} akun terdaftar</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-zinc-600">
                            Pastikan akses dan peran pengguna selalu terkontrol.
                        </div>
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-3">
                            <form method="GET" action="{{ route('admin.users.index') }}" class="w-full sm:w-[260px]">
                                <input
                                    type="text"
                                    name="q"
                                    value="{{ request('q') }}"
                                    placeholder="Cari pengguna..."
                                    class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900"
                                >
                            </form>
                            <a
                                href="{{ route('admin.users.create') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800"
                            >
                                + Tambah Pengguna
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-zinc-200">
                        <table class="w-full text-sm">
                            <thead class="bg-zinc-50">
                                <tr class="border-b border-zinc-200">
                                    <th class="w-[260px] px-4 py-3 text-left font-semibold">Nama</th>
                                    <th class="w-[200px] px-4 py-3 text-left font-semibold">Kontak</th>
                                    <th class="w-[180px] px-4 py-3 text-left font-semibold">Role</th>
                                    <th class="w-[140px] px-4 py-3 text-left font-semibold">Status</th>
                                    <th class="w-[240px] px-4 py-3 text-left font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    @php
                                        $isActive = $u->status === 'active';
                                    @endphp
                                    <tr class="border-b border-zinc-200 last:border-b-0">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                @if($u->foto_path)
                                                    <img src="{{ asset('storage/'.$u->foto_path) }}" alt="Foto {{ $u->name }}" class="h-10 w-10 rounded-xl object-cover">
                                                @else
                                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-100 text-sm font-semibold text-zinc-600">
                                                        {{ Str::upper(Str::substr($u->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium">{{ $u->name }}</div>
                                                    <div class="text-xs text-zinc-500">ID: {{ $u->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-zinc-800">{{ $u->email }}</div>
                                            @if($u->phone)
                                                <div class="text-xs text-zinc-500">Telp: {{ $u->phone }}</div>
                                            @endif
                                            @if($u->alamat)
                                                <div class="text-xs text-zinc-500">Alamat: {{ Str::limit($u->alamat, 60) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                @forelse($u->roles as $role)
                                                    <span class="inline-flex items-center rounded-lg border border-zinc-200 px-2.5 py-1 text-xs font-semibold">
                                                        {{ ucfirst(str_replace('_',' ', $role->name)) }}
                                                    </span>
                                                @empty
                                                    <span class="text-xs text-zinc-500">Belum ada role</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center rounded-lg border px-2.5 py-1 text-xs font-semibold {{ $isActive ? 'border-emerald-200 text-emerald-700' : 'border-rose-200 text-rose-700' }}">
                                                <span class="mr-2 h-2 w-2 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                                {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex flex-wrap gap-2">
                                                <a
                                                    href="{{ route('admin.users.edit', $u) }}"
                                                    class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                                >
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.users.reset-password', $u) }}" method="POST" onsubmit="return confirm('Reset password pengguna ini?')">
                                                    @csrf
                                                    <button
                                                        type="submit"
                                                        class="rounded-xl border border-zinc-200 px-3 py-1.5 text-xs font-semibold hover:bg-zinc-50"
                                                    >
                                                        Reset
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="rounded-xl border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-10 text-center text-sm text-zinc-500">
                                            Tidak ada pengguna yang cocok.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-xs text-zinc-500">
                            Menampilkan {{ $users->count() }} dari total {{ $users->total() }} pengguna
                        </div>
                        <div class="sm:flex sm:justify-end">
                            {{ $users->links() }}
                        </div>
                    </div>

                    <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm">
                        <span class="font-medium">Menu aktif:</span> {{ $activeMenu }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
