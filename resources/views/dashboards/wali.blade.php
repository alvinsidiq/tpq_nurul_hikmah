<x-app-layout>
    @php
        $userName = auth()->user()->name ?? 'Wali';
        $cards = [
            [
                'title' => 'Nilai Anak',
                'desc' => 'Lihat perkembangan nilai setiap mata pelajaran.',
                'href' => route('wali.nilai.index'),
                'cta' => 'Lihat Nilai',
            ],
            [
                'title' => 'Kehadiran',
                'desc' => 'Cek ringkasan kehadiran dan status detail.',
                'href' => route('wali.kehadiran.index'),
                'cta' => 'Cek Kehadiran',
            ],
            [
                'title' => 'Informasi Kelas',
                'desc' => 'Hubungi wali kelas atau guru untuk tindak lanjut.',
                'href' => route('wali.nilai.index'),
                'cta' => 'Lihat Detail',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6 space-y-4">
            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                <div class="flex flex-col gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-lg font-semibold">Dashboard Wali Santri</div>
                        <div class="text-sm text-zinc-600">Pantau progres anak</div>
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
                        Gunakan menu sidebar untuk akses modul lain dan filter nilai/kehadiran yang lebih detail.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
