<x-app-layout>
    <x-slot name="header"><h2>Rekap Per Kelas</h2></x-slot>
    <div class="p-6 space-y-4">
        <x-flash/>
        @include('admin.reports._filters')
        <div class="mt-4">
            <p class="text-sm text-gray-600">Hasil rekap akan ditampilkan di sini (belum diimplementasikan).</p>
        </div>
    </div>
</x-app-layout>

