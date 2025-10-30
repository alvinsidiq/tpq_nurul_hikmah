<x-app-layout>
    <x-slot name="header"><h2>Dashboard</h2></x-slot>
    <div class="p-6 space-y-6">
        <div>Selamat datang di {{ config('app.name') }}.</div>

        @role('admin')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.users.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Pengguna</div>
                <div class="text-2xl font-semibold">{{ \App\Models\User::count() }}</div>
            </a>
            <a href="{{ route('admin.guru.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Data Guru</div>
                <div class="text-2xl font-semibold">{{ \App\Models\Guru::count() }}</div>
            </a>
            <a href="{{ route('admin.santri.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Data Santri</div>
                <div class="text-2xl font-semibold">{{ \App\Models\Santri::count() }}</div>
            </a>
            <a href="{{ route('admin.kelas.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Kelas</div>
                <div class="text-2xl font-semibold">{{ \App\Models\Kelas::count() }}</div>
            </a>
            <a href="{{ route('admin.mapel.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Mata Pelajaran</div>
                <div class="text-2xl font-semibold">{{ \App\Models\MataPelajaran::count() }}</div>
            </a>
            <a href="{{ route('admin.ta.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">TA Aktif</div>
                <div class="text-2xl font-semibold">{{ \App\Models\TahunAjaran::where('aktif', true)->count() }}</div>
            </a>
            <a href="{{ route('admin.kegiatan.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Kegiatan</div>
                <div class="text-2xl font-semibold">{{ \App\Models\Kegiatan::count() }}</div>
            </a>
            <a href="{{ route('admin.jadwal.index') }}" class="block bg-white rounded shadow p-4 hover:shadow-md transition">
                <div class="text-sm text-gray-500">Jadwal</div>
                <div class="text-2xl font-semibold">{{ \App\Models\Jadwal::count() }}</div>
            </a>
        </div>
        @endrole
    </div>
</x-app-layout>
