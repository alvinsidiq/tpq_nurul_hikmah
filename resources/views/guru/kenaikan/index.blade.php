<x-app-layout>
    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-4xl p-6 space-y-4">
            <x-flash/>

            <div class="rounded-2xl border border-zinc-200 shadow-sm p-6">
                <div class="flex flex-col gap-2 border-b border-zinc-200 pb-4">
                    <div class="text-lg font-semibold">Kenaikan Jilid</div>
                    <div class="text-sm text-zinc-600">Panduan menentukan kenaikan jilid</div>
                </div>
                <div class="pt-4 space-y-3 text-sm text-zinc-700">
                    <p>Tentukan kenaikan jilid santri menggunakan data terbaru.</p>
                    <p>Silakan buka menu <strong>Kelas Saya</strong>, pilih kelas yang relevan, lalu gunakan data santri untuk menentukan kelayakan kenaikan jilid. Catat perubahan tersebut pada modul nilai atau catatan kelas sampai fitur khusus tersedia.</p>
                </div>
                <div class="mt-4">
                    <a class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800" href="{{ route('guru.kelas.index') }}">
                        Buka Kelas Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
