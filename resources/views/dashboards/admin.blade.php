<x-app-layout>
    @php
        $menu = $menu ?? [
            [
                'label' => 'Dashboard',
                'href' => route('admin.dashboard'),
                'active' => request()->routeIs('admin.dashboard'),
            ],
            [
                'label' => 'Data Pengguna',
                'href' => route('admin.users.index'),
                'active' => request()->routeIs('admin.users.*'),
            ],
            [
                'label' => 'Data Akademik',
                'href' => route('admin.semesters.index'),
                'active' => request()->routeIs('admin.semesters.*'),
            ],
            [
                'label' => 'Tahun Ajaran',
                'href' => route('admin.ta.index'),
                'active' => request()->routeIs('admin.ta.*'),
            ],
            [
                'label' => 'Mata Pelajaran',
                'href' => route('admin.mapel.index'),
                'active' => request()->routeIs('admin.mapel.*'),
            ],
            [
                'label' => 'Data Kelas',
                'href' => route('admin.kelas.index'),
                'active' => request()->routeIs('admin.kelas.*'),
            ],
            [
                'label' => 'Data Guru',
                'href' => route('admin.guru.index'),
                'active' => request()->routeIs('admin.guru.*'),
            ],
                    [
                        'label' => 'Data Santri',
                        'href' => route('admin.santri.index'),
                        'active' => request()->routeIs('admin.santri.*'),
                    ],
                    [
                        'label' => 'Kegiatan TPQ',
                        'href' => route('admin.kegiatan.index'),
                        'active' => request()->routeIs('admin.kegiatan.*'),
                    ],
            [
                'label' => 'Kelola Laporan',
                'href' => route('admin.reports.kehadiran'),
                'active' => request()->routeIs('admin.reports.*'),
            ],
            [
                'label' => 'Notifikasi',
                'href' => '#',
                'active' => false,
            ],
        ];

        $activeMenu = $activeMenu ?? 'Dashboard';
        foreach ($menu as $item) {
            if (!empty($item['active'])) {
                $activeMenu = $item['label'];
                break;
            }
        }

        $userName = $userName ?? (auth()->user()->name ?? 'Admin');
        $stats = $stats ?? [
            ['label' => 'Santri', 'value' => 145],
            ['label' => 'Guru', 'value' => 12],
            ['label' => 'Kelas', 'value' => 8],
            ['label' => 'Kehadiran Hari Ini', 'value' => '87%'],
        ];
        $activities = $activities ?? [
            ['date' => '2025-08-07', 'text' => 'Santri baru ditambahkan: Ahmad Fauzi'],
            ['date' => '2025-08-06', 'text' => 'Input nilai oleh Ustadz Abdullah'],
            ['date' => '2025-08-05', 'text' => 'Kelas baru dibuat: Iqro 2'],
        ];
    @endphp

    <div class="min-h-screen bg-white text-zinc-900">
        <div class="mx-auto max-w-5xl p-6">
            <div class="rounded-2xl border border-zinc-200 shadow-sm">

                {{-- Header --}}
                <div class="flex flex-col items-start gap-2 border-b border-zinc-200 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="text-lg font-semibold">Dashboard Admin</div>
                    <div class="text-sm text-zinc-600">Halo, {{ $userName }}</div>
                </div>

                <div class="p-4">
                    {{-- Stats --}}
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-4">
                        @foreach ($stats as $s)
                            <div class="rounded-2xl border border-zinc-200 shadow-sm">
                                <div class="p-4 pb-2">
                                    <div class="text-sm font-medium text-zinc-600">{{ $s['label'] }}</div>
                                </div>
                                <div class="px-4 pb-4">
                                    <div class="text-2xl font-semibold">{{ $s['value'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Grafik Kehadiran --}}
                    <div class="mt-4">
                        <div class="rounded-2xl border border-zinc-200 shadow-sm">
                            <div class="p-4 pb-2">
                                <div class="text-base font-semibold">Grafik Kehadiran Bulanan</div>
                            </div>
                            <div class="p-4">
                                <div class="flex h-[220px] items-center justify-center rounded-xl border border-dashed border-zinc-300 text-xs text-zinc-500">
                                    [GRAFIK KEHADIRAN]
                                </div>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    <button class="rounded-xl border border-zinc-200 px-4 py-2 text-sm hover:bg-zinc-50">Bulan ini</button>
                                    <button class="rounded-xl border border-zinc-200 px-4 py-2 text-sm hover:bg-zinc-50">3 bulan</button>
                                    <button class="rounded-xl border border-zinc-200 px-4 py-2 text-sm hover:bg-zinc-50">12 bulan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Aktivitas Terbaru --}}
                    <div class="mt-4">
                        <div class="rounded-2xl border border-zinc-200 shadow-sm">
                            <div class="p-4 pb-2">
                                <div class="text-base font-semibold">Aktivitas Terbaru</div>
                            </div>

                            <div class="p-4">
                                <div class="overflow-hidden rounded-xl border border-zinc-200">
                                    <table class="w-full text-sm">
                                        <thead class="bg-zinc-50">
                                            <tr class="border-b border-zinc-200">
                                                <th class="w-[160px] px-4 py-3 text-left font-semibold">Tanggal</th>
                                                <th class="px-4 py-3 text-left font-semibold">Aktivitas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $a)
                                                <tr class="border-b border-zinc-200 last:border-b-0">
                                                    <td class="px-4 py-3 font-medium">{{ $a['date'] }}</td>
                                                    <td class="px-4 py-3">{{ $a['text'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="text-xs text-zinc-500">
                                        Menampilkan {{ count($activities) }} aktivitas terbaru
                                    </div>
                                    <a href="{{ route('admin.reports.kehadiran') }}" class="inline-flex justify-center rounded-xl bg-zinc-900 px-4 py-2 text-sm text-white hover:bg-zinc-800">
                                        Lihat semua
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Note menu aktif --}}
                    <div class="mt-4 rounded-2xl border border-zinc-200 bg-zinc-50 p-4 text-sm">
                        <span class="font-medium">Menu aktif:</span> {{ $activeMenu }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
