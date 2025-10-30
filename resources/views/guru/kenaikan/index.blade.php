<x-app-layout>
    <x-slot name="header"><h2>Kenaikan Jilid</h2></x-slot>
    <div class="p-6 max-w-3xl">
        <x-flash/>
        <p class="mb-3">Kelola kenaikan jilid santri. Silakan pilih kelas dari menu "Kelas Saya" untuk melihat santri, lalu tetapkan kenaikan jilid sesuai kebijakan madrasah.</p>
        <p class="text-sm text-gray-600">(Halaman ini placeholder. Kita bisa menambahkan form khusus per kelas bila diinginkan.)</p>
        <div class="mt-4">
            <a class="underline text-blue-600" href="{{ route('guru.kelas.index') }}">Buka Kelas Saya</a>
        </div>
    </div>
</x-app-layout>

