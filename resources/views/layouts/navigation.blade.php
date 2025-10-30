<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
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
                    <x-nav-link :href="route('admin.guru.index')" :active="request()->routeIs('admin.guru.*')">
                        {{ __('Data Guru') }}
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
                    <x-nav-link :href="route('admin.ta.index')" :active="request()->routeIs('admin.ta.*')">
                        {{ __('Tahun Ajaran') }}
                    </x-nav-link>
                    @php
                        $akActive = request()->routeIs('admin.ta.*') || request()->routeIs('admin.semesters.*') || request()->routeIs('admin.mapel.*') || request()->routeIs('admin.kelas.*');
                        $akClasses = $akActive
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
                    @endphp
                    <x-dropdown align="left" width="48" class="inline-flex items-center">
                        <x-slot name="trigger">
                            <button type="button" class="{{ $akClasses }}">
                                {{ __('Kelola Data Akademik') }}
                                <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="http://127.0.0.1:8000/admin/ta">
                                {{ __('Tahun Ajaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.semesters.index')" :active="request()->routeIs('admin.semesters.*')">
                                {{ __('Semester') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                                {{ __('Mata Pelajaran') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                                {{ __('Kelas') }}
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
                    <x-nav-link :href="route('guru.kelas.index')" :active="request()->routeIs('guru.kelas.*')">
                        {{ __('Lihat Data Santri') }}
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
            <x-responsive-nav-link :href="route('admin.guru.index')" :active="request()->routeIs('admin.guru.*')">
                {{ __('Data Guru') }}
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
            <x-responsive-nav-link :href="route('admin.ta.index')" :active="request()->routeIs('admin.ta.*')">
                {{ __('Tahun Ajaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.semesters.index')" :active="request()->routeIs('admin.semesters.*')">
                {{ __('Semester') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.mapel.index')" :active="request()->routeIs('admin.mapel.*')">
                {{ __('Mata Pelajaran') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.kelas.index')" :active="request()->routeIs('admin.kelas.*')">
                {{ __('Kelas') }}
            </x-responsive-nav-link>
            @endrole
            @role('guru')
            <x-responsive-nav-link :href="route('guru.dashboard')" :active="request()->routeIs('guru.dashboard')">
                {{ __('Guru') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.kelas.index')" :active="request()->routeIs('guru.kelas.*')">
                {{ __('Kelas Saya') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.kelas.index')" :active="request()->routeIs('guru.kelas.*')">
                {{ __('Lihat Data Santri') }}
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
