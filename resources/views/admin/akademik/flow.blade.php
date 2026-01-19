<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Flow Data Akademik</div>
                        <div class="text-sm text-zinc-600">Urutan kerja admin agar data akademik konsisten.</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ auth()->user()->name ?? 'Admin' }}</div>
                </div>
                <div class="p-4 text-sm text-zinc-700">
                    Ikuti langkah berikut sebelum mengatur jadwal dan penilaian.
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm space-y-2">
                    <div class="text-xs uppercase text-zinc-500">Langkah 1</div>
                    <div class="text-base font-semibold">Tahun Ajaran</div>
                    <div class="text-sm text-zinc-600">Buat atau aktifkan tahun ajaran yang berlaku.</div>
                    <a href="{{ route('admin.ta.index') }}" class="inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                        Kelola Tahun Ajaran
                    </a>
                </div>
                <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm space-y-2">
                    <div class="text-xs uppercase text-zinc-500">Langkah 2</div>
                    <div class="text-base font-semibold">Periode Pengajaran</div>
                    <div class="text-sm text-zinc-600">Tentukan rentang semester/periode belajar.</div>
                    <a href="{{ route('admin.semesters.index') }}" class="inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                        Kelola Periode
                    </a>
                </div>
                <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm space-y-2">
                    <div class="text-xs uppercase text-zinc-500">Langkah 3</div>
                    <div class="text-base font-semibold">Mata Pelajaran</div>
                    <div class="text-sm text-zinc-600">Isi daftar mapel dan level/jilid yang sesuai.</div>
                    <a href="{{ route('admin.mapel.index') }}" class="inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                        Kelola Mata Pelajaran
                    </a>
                </div>
                <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm space-y-2">
                    <div class="text-xs uppercase text-zinc-500">Langkah 4</div>
                    <div class="text-base font-semibold">Kelas</div>
                    <div class="text-sm text-zinc-600">Buat kelas, kapasitas, dan wali kelas (opsional).</div>
                    <a href="{{ route('admin.kelas.index') }}" class="inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                        Kelola Kelas
                    </a>
                </div>
                <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm space-y-2 md:col-span-2">
                    <div class="text-xs uppercase text-zinc-500">Langkah 5</div>
                    <div class="text-base font-semibold">Jadwal & Guru Pengajar</div>
                    <div class="text-sm text-zinc-600">Atur guru pengajar untuk setiap mapel per kelas.</div>
                    <a href="{{ route('admin.jadwal.index') }}" class="inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                        Kelola Jadwal
                    </a>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700">
                Wali kelas bersifat opsional. Guru pengajar mapel ditentukan melalui menu Jadwal dan dapat berbeda dari wali kelas.
            </div>
        </div>
    </div>
</x-app-layout>
