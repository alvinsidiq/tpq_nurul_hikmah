<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Guru';
        $cards = [
            [
                'title' => 'Kelas Saya',
                'desc' => 'Kelola santri, jadwal, dan progres kelas.',
                'href' => route('guru.kelas.index'),
                'cta' => 'Buka Kelas',
            ],
            [
                'title' => 'Kehadiran',
                'desc' => 'Catat status santri untuk setiap pertemuan.',
                'href' => route('guru.kehadiran.index'),
                'cta' => 'Kelola Presensi',
            ],
            [
                'title' => 'Nilai',
                'desc' => 'Input nilai UH, UTS, UAS, atau praktik.',
                'href' => route('guru.nilai.index'),
                'cta' => 'Input Nilai',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6 space-y-4">
            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Dashboard Guru</div>
                        <div class="text-sm text-zinc-600">Akses cepat ke modul guru</div>
                    </div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4 space-y-4">
                    <div class="grid gap-3 md:grid-cols-3">
                        @foreach($cards as $c)
                            <div class="rounded-2xl border border-zinc-200 p-4 shadow-sm">
                                <div class="text-base font-semibold">{{ $c['title'] }}</div>
                                <div class="mt-1 text-sm text-zinc-600">{{ $c['desc'] }}</div>
                                <a href="{{ $c['href'] }}" class="mt-3 inline-flex rounded-xl border border-zinc-200 px-3 py-2 text-sm font-semibold hover:bg-zinc-50">
                                    {{ $c['cta'] }}
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm">
                        Gunakan menu sidebar untuk akses modul lain seperti Kehadiran, Nilai, dan Kenaikan Jilid.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
