<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Admin';
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-4xl p-6 space-y-4">
            <x-flash />

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Tambah Pengguna</div>
                        <div class="text-sm text-zinc-600">Isi informasi akun dengan lengkap</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.users.store') }}" class="p-4 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Nama</label>
                            <input name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Telepon</label>
                            <input name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-semibold text-zinc-800">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Status</label>
                            <select name="status" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                <option value="active" @selected(old('status')==='active')>Aktif</option>
                                <option value="inactive" @selected(old('status')==='inactive')>Nonaktif</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Foto</label>
                            <input type="file" name="foto" accept="image/*" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Role</label>
                            <select name="role" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                                <option value="admin" @selected(old('role')==='admin')>Admin</option>
                                <option value="guru" @selected(old('role')==='guru')>Guru</option>
                                <option value="wali_santri" @selected(old('role')==='wali_santri')>Wali Santri</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Password</label>
                            <input type="password" name="password" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-zinc-800">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm outline-none focus:border-zinc-900" required>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-4 sm:flex-row sm:items-center sm:justify-end">
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-200 px-4 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-50">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800">
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
