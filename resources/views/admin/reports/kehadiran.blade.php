<x-app-layout>
    <x-slot name="header"><h2>Laporan Kehadiran</h2></x-slot>

    <div class="min-h-screen bg-white py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="mb-6">
                    <p class="text-sm uppercase tracking-[0.3em] text-zinc-600 font-semibold">Filter Kehadiran</p>
                    <p class="text-2xl font-bold text-zinc-900">Sesuaikan rentang laporan sesuai kebutuhan</p>
                </div>
                @include('admin.reports._filters')
            </div>

            <div class="rounded-2xl border border-zinc-200 bg-white p-8 text-center shadow-sm">
                <p class="text-base font-semibold text-zinc-900">Hasil laporan akan ditampilkan di sini.</p>
                <p class="text-sm text-zinc-600 mt-2">Belum ada data yang dirender. Silakan pilih filter di atas untuk menampilkan tabel kehadiran.</p>
            </div>
        </div>
    </div>
</x-app-layout>
