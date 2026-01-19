@php
    $isAdmin = auth()->check() && auth()->user()->hasRole('admin');
    $adminSidebarEnabled = $isAdmin;
    $hasGuruSidebar = auth()->check() && auth()->user()->hasRole('guru');
    $hasWaliSidebar = auth()->check() && auth()->user()->hasRole('wali_santri');
    $navClasses = 'bg-white border-b border-gray-100';

    if ($adminSidebarEnabled || $hasGuruSidebar || $hasWaliSidebar) {
        $navClasses .= ' lg:hidden';
    }
@endphp

<nav x-data="{ open: false }" class="{{ $navClasses }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @role('admin')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Pengguna') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.santri.index')" :active="request()->routeIs('admin.santri.*')">
                        {{ __('Data Santri') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')">
                        {{ __('Kegiatan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')">
                        {{ __('Jadwal') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.reports.kehadiran')" :active="request()->routeIs('admin.reports.*')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                    @php
                        $akActive = request()->routeIs('admin.akademik.*') || request()->routeIs('admin.ta.*') || request()->routeIs('admin.semesters.*') || request()->routeIs('admin.mapel.*') || request()->routeIs('admin.kelas.*');
                        $akClasses = $akActive
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
                    @endphp
                    <x-dropdown align="left" width="48" class="inline-flex items-center">
                        <x-slot name="trigger">
                            <button type="button" class="{{ $akClasses }}">
                                {{ __('Data Akademik') }}
                                <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.akademik.flow')" :active="request()->routeIs('admin.akademik.*')">
                                {{ __('Flow Akademik') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.ta.index')" :active="request()->routeIs('admin.ta.*')">
                                {{ __('Tahun Ajaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.semesters.index')" :active="request()->routeIs('admin.semesters.*')">
                                {{ __('Periode Pengajaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                                {{ __('Mata Pelajaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                                {{ __('Data Kelas') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @endrole
@role('guru')
                    <x-nav-link :href="route('guru.dashboard')" :active="request()->routeIs('guru.dashboard')">
                        {{ __('Guru') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.kelas.index')" :active="request()->routeIs('guru.kelas.*')">
                        {{ __('Kelas Saya') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.mapel.index')" :active="request()->routeIs('guru.mapel.*')">
                        {{ __('Mata Pelajaran') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.kehadiran.index')" :active="request()->routeIs('guru.kehadiran.*')">
                        {{ __('Kelola Kehadiran') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.nilai.index')" :active="request()->routeIs('guru.nilai.*')">
                        {{ __('Kelola Nilai') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.kenaikan.index')" :active="request()->routeIs('guru.kenaikan.*')">
                        {{ __('Kenaikan Jilid') }}
                    </x-nav-link>
@endrole
                    @role('wali_santri')
                    <x-nav-link :href="route('wali.dashboard')" :active="request()->routeIs('wali.dashboard')">
                        {{ __('Wali') }}
                    </x-nav-link>
                    <x-nav-link :href="route('wali.nilai.index')" :active="request()->routeIs('wali.nilai.*')">
                        {{ __('Nilai Anak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('wali.kehadiran.index')" :active="request()->routeIs('wali.kehadiran.*')">
                        {{ __('Kehadiran Anak') }}
                    </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @role('admin')
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Admin') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                {{ __('Pengguna') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.santri.index')" :active="request()->routeIs('admin.santri.*')">
                {{ __('Data Santri') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kegiatan.index')" :active="request()->routeIs('admin.kegiatan.*')">
                {{ __('Kegiatan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.jadwal.index')" :active="request()->routeIs('admin.jadwal.*')">
                {{ __('Jadwal') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.reports.kehadiran')" :active="request()->routeIs('admin.reports.*')">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
            @php
                $akActive = request()->routeIs('admin.akademik.*') || request()->routeIs('admin.ta.*') || request()->routeIs('admin.semesters.*') || request()->routeIs('admin.mapel.*') || request()->routeIs('admin.kelas.*');
            @endphp
            <div x-data="{ openAk: false }">
                <button @click="openAk = !openAk"
                    class="w-full flex items-center justify-between px-4 py-2 text-sm font-medium text-left text-gray-700 hover:bg-gray-100 focus:outline-none">
                    <span class="{{ $akActive ? 'font-semibold text-gray-900' : '' }}">{{ __('Data Akademik') }}</span>
                    <svg :class="{ 'rotate-180': openAk }" class="h-4 w-4 text-gray-500 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="openAk" class="space-y-1 pb-2" x-cloak>
                    <x-responsive-nav-link :href="route('admin.akademik.flow')" :active="request()->routeIs('admin.akademik.*')">
                        {{ __('Flow Akademik') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.ta.index')" :active="request()->routeIs('admin.ta.*')">
                        {{ __('Tahun Ajaran') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.semesters.index')" :active="request()->routeIs('admin.semesters.*')">
                        {{ __('Periode Pengajaran') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                        {{ __('Mata Pelajaran') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                        {{ __('Data Kelas') }}
                    </x-responsive-nav-link>
                </div>
            </div>
            @endrole
            @role('guru')
            <x-responsive-nav-link :href="route('guru.dashboard')" :active="request()->routeIs('guru.dashboard')">
                {{ __('Guru') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.kelas.index')" :active="request()->routeIs('guru.kelas.*')">
                {{ __('Kelas Saya') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.mapel.index')" :active="request()->routeIs('guru.mapel.*')">
                {{ __('Mata Pelajaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.kehadiran.index')" :active="request()->routeIs('guru.kehadiran.*')">
                {{ __('Kelola Kehadiran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.nilai.index')" :active="request()->routeIs('guru.nilai.*')">
                {{ __('Kelola Nilai') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.kenaikan.index')" :active="request()->routeIs('guru.kenaikan.*')">
                {{ __('Kenaikan Jilid') }}
            </x-responsive-nav-link>
            @endrole
            @role('wali_santri')
            <x-responsive-nav-link :href="route('wali.dashboard')" :active="request()->routeIs('wali.dashboard')">
                {{ __('Wali') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('wali.nilai.index')" :active="request()->routeIs('wali.nilai.*')">
                {{ __('Nilai Anak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('wali.kehadiran.index')" :active="request()->routeIs('wali.kehadiran.*')">
                {{ __('Kehadiran Anak') }}
            </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@if($adminSidebarEnabled)
    @php
        $akActive = request()->routeIs('admin.akademik.*') || request()->routeIs('admin.ta.*') || request()->routeIs('admin.semesters.*') || request()->routeIs('admin.mapel.*') || request()->routeIs('admin.kelas.*');

        $adminMenu = [
            [
                'type' => 'link',
                'label' => __('Dashboard'),
                'href' => route('admin.dashboard'),
                'active' => request()->routeIs('admin.dashboard'),
            ],
            [
                'type' => 'link',
                'label' => __('Data Pengguna'),
                'href' => route('admin.users.index'),
                'active' => request()->routeIs('admin.users.*'),
            ],
            [
                'type' => 'group',
                'label' => __('Data Akademik'),
                'active' => $akActive,
                'children' => [
                    [
                        'label' => __('Flow Akademik'),
                        'href' => route('admin.akademik.flow'),
                        'active' => request()->routeIs('admin.akademik.*'),
                    ],
                    [
                        'label' => __('Tahun Ajaran'),
                        'href' => route('admin.ta.index'),
                        'active' => request()->routeIs('admin.ta.*'),
                    ],
                    [
                        'label' => __('Periode Pengajaran'),
                        'href' => route('admin.semesters.index'),
                        'active' => request()->routeIs('admin.semesters.*'),
                    ],
                    [
                        'label' => __('Mata Pelajaran'),
                        'href' => route('admin.mapel.index'),
                        'active' => request()->routeIs('admin.mapel.*'),
                    ],
                    [
                        'label' => __('Data Kelas'),
                        'href' => route('admin.kelas.index'),
                        'active' => request()->routeIs('admin.kelas.*'),
                    ],
                ],
            ],
            [
                'type' => 'link',
                'label' => __('Data Santri'),
                'href' => route('admin.santri.index'),
                'active' => request()->routeIs('admin.santri.*'),
            ],
            [
                'type' => 'link',
                'label' => __('Jadwal'),
                'href' => route('admin.jadwal.index'),
                'active' => request()->routeIs('admin.jadwal.*'),
            ],
            [
                'type' => 'link',
                'label' => __('Kegiatan TPQ'),
                'href' => route('admin.kegiatan.index'),
                'active' => request()->routeIs('admin.kegiatan.*'),
            ],
            [
                'type' => 'link',
                'label' => __('Laporan'),
                'href' => route('admin.reports.kehadiran'),
                'active' => request()->routeIs('admin.reports.*'),
            ],
            [
                'type' => 'link',
                'label' => __('Notifikasi'),
                'href' => '#',
                'active' => false,
            ],
        ];
    @endphp

    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-64 bg-white border-r border-zinc-200 shadow-sm z-30">
        <div class="px-5 py-5 border-b border-zinc-200 flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="shrink-0">
                <x-application-logo class="block h-9 w-auto fill-current text-zinc-900" />
            </a>
            <div>
                <p class="text-base font-semibold text-zinc-900">{{ config('app.name', 'Laravel') }}</p>
                <p class="text-sm text-zinc-500">{{ __('Panel Admin') }}</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto p-4" aria-label="{{ __('Navigasi Admin') }}">
            <div class="grid gap-2">
                @foreach ($adminMenu as $item)
                    @if(($item['type'] ?? 'link') === 'group')
                        <div x-data="{ open: {{ $item['active'] ? 'true' : 'false' }} }" class="rounded-xl border border-zinc-200">
                            <button @click="open = !open" type="button"
                                class="flex w-full items-center justify-between px-3 py-2 text-left text-sm font-medium transition {{ $item['active'] ? 'bg-zinc-50 font-semibold text-zinc-900' : 'hover:bg-zinc-50 text-zinc-800' }}">
                                <span>{{ $item['label'] }}</span>
                                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 text-zinc-500 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" x-cloak class="space-y-1 border-t border-zinc-200 p-2">
                                @foreach($item['children'] as $child)
                                    <a href="{{ $child['href'] }}"
                                        class="block w-full rounded-lg border px-3 py-2 text-left text-sm transition {{ $child['active'] ? 'border-zinc-900 bg-zinc-50 font-semibold' : 'border-transparent hover:bg-zinc-50' }}">
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item['href'] }}"
                            class="w-full rounded-xl border px-3 py-2 text-left text-sm transition {{ $item['active'] ? 'border-zinc-900 bg-zinc-50 font-semibold' : 'border-zinc-200 hover:bg-zinc-50' }}">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </nav>

        <div class="border-t border-zinc-200 px-4 py-5 space-y-3">
            <div>
                <p class="text-sm font-medium text-zinc-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-zinc-500">{{ Auth::user()->email }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-zinc-900 hover:text-zinc-700">
                    {{ __('Kelola Profil') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm font-semibold text-zinc-700 hover:text-red-600">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </aside>
@endif

@if($hasGuruSidebar)
    @php
        $guruLinks = [
            [
                'label' => __('Dashboard Guru'),
                'href' => route('guru.dashboard'),
                'active' => request()->routeIs('guru.dashboard'),
            ],
            [
                'label' => __('Kelas Saya'),
                'href' => route('guru.kelas.index'),
                'active' => request()->routeIs('guru.kelas.*'),
            ],
            [
                'label' => __('Mata Pelajaran'),
                'href' => route('guru.mapel.index'),
                'active' => request()->routeIs('guru.mapel.*'),
            ],
            [
                'label' => __('Kelola Kehadiran'),
                'href' => route('guru.kehadiran.index'),
                'active' => request()->routeIs('guru.kehadiran.*'),
            ],
            [
                'label' => __('Kelola Nilai'),
                'href' => route('guru.nilai.index'),
                'active' => request()->routeIs('guru.nilai.*'),
            ],
            [
                'label' => __('Kenaikan Jilid'),
                'href' => route('guru.kenaikan.index'),
                'active' => request()->routeIs('guru.kenaikan.*'),
            ],
        ];
    @endphp

    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-60 bg-white border-r border-zinc-200 shadow-sm z-20">
        <div class="px-6 py-5 border-b border-zinc-200 flex items-center gap-3">
            <a href="{{ route('guru.dashboard') }}" class="shrink-0">
                <x-application-logo class="block h-10 w-auto fill-current text-zinc-900" />
            </a>
            <div>
                <p class="text-base font-semibold text-zinc-900">{{ config('app.name', 'Laravel') }}</p>
                <p class="text-sm text-zinc-500">{{ __('Panel Guru') }}</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto p-4 space-y-2" aria-label="{{ __('Navigasi Guru') }}">
            @foreach ($guruLinks as $link)
                <a href="{{ $link['href'] }}"
                    class="block w-full rounded-xl border px-3 py-2 text-left text-sm transition {{ $link['active'] ? 'border-zinc-900 bg-zinc-50 font-semibold' : 'border-zinc-200 hover:bg-zinc-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="border-t border-zinc-200 px-4 py-5 space-y-3">
            <div>
                <p class="text-sm font-medium text-zinc-900">{{ Auth::user()->name }}</p>
                <p class="text-xs text-zinc-500">{{ Auth::user()->email }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-zinc-900 hover:text-zinc-700">
                    {{ __('Kelola Profil') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm font-semibold text-zinc-700 hover:text-red-600">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </aside>
@endif

@if($hasWaliSidebar)
    @php
        $waliLinks = [
            [
                'label' => __('Dashboard Wali'),
                'href' => route('wali.dashboard'),
                'active' => request()->routeIs('wali.dashboard'),
            ],
            [
                'label' => __('Nilai Anak'),
                'href' => route('wali.nilai.index'),
                'active' => request()->routeIs('wali.nilai.*'),
            ],
            [
                'label' => __('Kehadiran Anak'),
                'href' => route('wali.kehadiran.index'),
                'active' => request()->routeIs('wali.kehadiran.*'),
            ],
        ];
    @endphp

    <aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:w-60 bg-white border-r border-zinc-200 shadow-sm z-20">
        <div class="px-6 py-5 border-b border-zinc-200 flex items-center gap-3">
            <a href="{{ route('wali.dashboard') }}" class="shrink-0">
                <x-application-logo class="block h-10 w-auto fill-current text-zinc-900" />
            </a>
            <div>
                <p class="text-base font-semibold text-zinc-900">{{ config('app.name', 'Laravel') }}</p>
                <p class="text-sm text-zinc-500">{{ __('Panel Wali Santri') }}</p>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto p-4 space-y-2" aria-label="{{ __('Navigasi Wali') }}">
            @foreach ($waliLinks as $link)
                <a href="{{ $link['href'] }}"
                    class="block w-full rounded-xl border px-3 py-2 text-left text-sm transition {{ $link['active'] ? 'border-zinc-900 bg-zinc-50 font-semibold' : 'border-zinc-200 hover:bg-zinc-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="border-t border-zinc-200 px-4 py-5 space-y-3">
            <div class="flex items-center gap-3">
                <div class="flex-1">
                    <p class="text-sm font-medium text-zinc-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-zinc-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-zinc-900 hover:text-zinc-700">
                    {{ __('Kelola Profil') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm font-semibold text-zinc-700 hover:text-red-600">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </aside>
@endif
