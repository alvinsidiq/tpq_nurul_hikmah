<x-app-layout>
    <x-slot name="header"><h2>Tambah Pengguna</h2></x-slot>
    <div class="p-6 max-w-2xl">
        <x-flash/>
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block">Nama</label>
                <input name="name" value="{{ old('name') }}" class="border p-2 w-full" required>
            </div>
            <div>
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full" required>
            </div>
            <div>
                <label class="block">Telepon</label>
                <input name="phone" value="{{ old('phone') }}" class="border p-2 w-full">
            </div>
            <div>
                <label class="block">Status</label>
                <select name="status" class="border p-2 w-full" required>
                    <option value="active" @selected(old('status')==='active')>Aktif</option>
                    <option value="inactive" @selected(old('status')==='inactive')>Nonaktif</option>
                </select>
            </div>
            <div>
                <label class="block">Role</label>
                <select name="role" class="border p-2 w-full" required>
                    <option value="admin" @selected(old('role')==='admin')>Admin</option>
                    <option value="guru" @selected(old('role')==='guru')>Guru</option>
                    <option value="wali_santri" @selected(old('role')==='wali_santri')>Wali Santri</option>
                </select>
            </div>
            <div>
                <label class="block">Password</label>
                <input type="password" name="password" class="border p-2 w-full" required>
            </div>
            <div>
                <label class="block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="border p-2 w-full" required>
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="ml-2 underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>

