<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
        $isEdit = $item->exists;
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-4xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">{{ $isEdit ? 'Edit Guru' : 'Tambah Guru' }}</div>
                        <div class="text-sm text-zinc-600">{{ $isEdit ? $item->nama_lengkap : 'Lengkapi data guru' }}</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" action="{{ $isEdit ? route('admin.guru.update', $item) : route('admin.guru.store') }}" class="p-4 space-y-6">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Nama Lengkap</label>
                            <input name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Email</label>
                            <input type="email" name="email" value="{{ old('email', $item->user->email ?? '') }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">No Telepon</label>
                            <input name="no_telepon" value="{{ old('no_telepon', $item->no_telepon) }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">{{ old('alamat', $item->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.guru.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
