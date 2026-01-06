<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="TPQ Nurul Hikmah - Tempat pembelajaran Al-Qur'an dan pembinaan akhlak untuk anak-anak.">

        <title>TPQ Nurul Hikmah</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-800">
        <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-100">
            <header class="relative bg-white/80 backdrop-blur border-b border-white/40">
                <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-lg">
                            TPQ
                        </div>
                        <div>
                            <p class="text-lg font-semibold">TPQ Nurul Hikmah</p>
                            <p class="text-sm text-gray-500">Mencetak generasi Qur'ani</p>
                        </div>
                    </div>
                    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-600">
                        <a href="#tentang" class="hover:text-indigo-600">Tentang</a>
                        <a href="#program" class="hover:text-indigo-600">Program</a>
                        <a href="#pengajar" class="hover:text-indigo-600">Pengajar</a>
                        <a href="#kegiatan" class="hover:text-indigo-600">Kegiatan</a>
                        <a href="#kontak" class="hover:text-indigo-600">Kontak</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-indigo-600 text-white shadow">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl border border-indigo-200 text-indigo-600 hover:bg-indigo-50">Masuk</a>
                            @endauth
                        @endif
                    </nav>
                </div>
            </header>

            <section class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-6 py-16 md:py-24 grid gap-10 md:grid-cols-2 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Selamat datang</p>
                        <h1 class="mt-4 text-4xl md:text-5xl font-bold text-gray-900 leading-tight">TPQ Nurul Hikmah – Membentuk Generasi Cinta Al-Qur'an</h1>
                        <p class="mt-4 text-gray-600">Kami berkomitmen menghadirkan lingkungan belajar yang menyenangkan, penuh kasih sayang, dan berbasis nilai-nilai Islam. Bergabunglah bersama ratusan santri yang tumbuh bersama Al-Qur'an.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="#pendaftaran" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 hover:-translate-y-0.5 hover:shadow-xl transition">Daftar Sekarang</a>
                            <a href="#kegiatan" class="inline-flex items-center justify-center rounded-xl border border-indigo-200 px-6 py-3 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 transition">Lihat Kegiatan</a>
                        </div>
                        <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                            <div class="rounded-2xl bg-white/80 backdrop-blur border border-white/40 p-4 shadow">
                                <p class="text-3xl font-bold text-indigo-600">250+</p>
                                <p class="text-sm text-gray-500">Santri Aktif</p>
                            </div>
                            <div class="rounded-2xl bg-white/80 backdrop-blur border border-white/40 p-4 shadow">
                                <p class="text-3xl font-bold text-indigo-600">15</p>
                                <p class="text-sm text-gray-500">Ustadz/Ustadzah</p>
                            </div>
                            <div class="rounded-2xl bg-white/80 backdrop-blur border border-white/40 p-4 shadow">
                                <p class="text-3xl font-bold text-indigo-600">10+</p>
                                <p class="text-sm text-gray-500">Program</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="rounded-3xl overflow-hidden shadow-2xl shadow-indigo-200">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80" alt="Belajar Al-Qur'an" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-8 -right-6 bg-white/90 backdrop-blur rounded-2xl border border-white/40 shadow-lg p-5 w-64">
                            <p class="text-sm text-gray-600">"Lingkungan TPQ yang hangat dan penuh semangat membuat anak kami jatuh cinta pada Al-Qur'an."</p>
                            <p class="mt-3 text-sm font-semibold text-gray-900">– Orang Tua Santri</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="tentang" class="py-16">
                <div class="max-w-7xl mx-auto px-6 grid gap-10 md:grid-cols-2 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Tentang Kami</p>
                        <h2 class="mt-4 text-3xl font-bold text-gray-900">Mengajarkan Al-Qur'an dengan Cinta, Disiplin, dan Teladan</h2>
                        <p class="mt-4 text-gray-600">TPQ Nurul Hikmah didirikan sebagai wadah pembelajaran Al-Qur'an yang menekankan kedisiplinan, akhlak mulia, dan kecintaan kepada Islam. Kami memiliki kurikulum terstruktur dari pengenalan huruf hijaiyah, tahsin, tahfidz, hingga pembinaan ibadah dan adab keseharian.</p>
                        <ul class="mt-6 space-y-3 text-gray-700">
                            <li class="flex items-start gap-3"><span class="h-2 w-2 rounded-full bg-indigo-600 mt-2"></span> Pengajar berpengalaman dan bersertifikasi.</li>
                            <li class="flex items-start gap-3"><span class="h-2 w-2 rounded-full bg-indigo-600 mt-2"></span> Program belajar menyenangkan berbasis permainan edukatif.</li>
                            <li class="flex items-start gap-3"><span class="h-2 w-2 rounded-full bg-indigo-600 mt-2"></span> Monitoring perkembangan santri melalui aplikasi.</li>
                            <li class="flex items-start gap-3"><span class="h-2 w-2 rounded-full bg-indigo-600 mt-2"></span> Kegiatan ekstra seperti pesantren kilat dan parenting class.</li>
                        </ul>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="rounded-3xl bg-white/90 backdrop-blur border border-white/40 p-6 shadow">
                            <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Visi</p>
                            <p class="mt-2 text-gray-700">Menjadi TPQ unggulan yang mencetak santri berakhlak mulia, cinta Al-Qur'an, dan siap menghadapi tantangan zaman.</p>
                        </div>
                        <div class="rounded-3xl bg-white/90 backdrop-blur border border-white/40 p-6 shadow">
                            <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Misi</p>
                            <p class="mt-2 text-gray-700">Menghadirkan pembelajaran Al-Qur'an yang inspiratif, melibatkan orang tua, dan memanfaatkan teknologi untuk memantau progres santri.</p>
                        </div>
                        <div class="rounded-3xl bg-white/90 backdrop-blur border border-white/40 p-6 shadow sm:col-span-2">
                            <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Fasilitas</p>
                            <p class="mt-2 text-gray-700">Ruang belajar nyaman, kitab dan modul terbarukan, sistem administrasi digital, serta laporan perkembangan yang dapat diakses wali.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="program" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-6">
                    <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold text-center">Program Unggulan</p>
                    <h2 class="mt-4 text-3xl font-bold text-center text-gray-900">Pembelajaran Terstruktur Sesuai Usia dan Kemampuan</h2>
                    <div class="mt-10 grid gap-6 md:grid-cols-3">
                        <div class="rounded-3xl border border-gray-100 p-6 shadow-sm bg-white/80">
                            <p class="text-xs uppercase tracking-[0.3em] text-indigo-500 font-semibold">Level Dasar</p>
                            <h3 class="mt-2 text-xl font-semibold text-gray-900">Pra-Tahsin</h3>
                            <p class="mt-3 text-gray-600">Pengenalan huruf hijaiyah, teknik membaca dasar, doa harian, dan adab ibadah sederhana.</p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <li>☑️ Kelas interaktif 3x seminggu</li>
                                <li>☑️ Modul belajar bergambar</li>
                                <li>☑️ Monitoring perkembangan via aplikasi</li>
                            </ul>
                        </div>
                        <div class="rounded-3xl border border-gray-100 p-6 shadow-md bg-indigo-50/60">
                            <p class="text-xs uppercase tracking-[0.3em] text-indigo-600 font-semibold">Level Menengah</p>
                            <h3 class="mt-2 text-xl font-semibold text-gray-900">Tahsin & Tahfidz</h3>
                            <p class="mt-3 text-gray-600">Fokus pada perbaikan tajwid, muroja'ah, hafalan juz 30, serta pembentukan karakter islami.</p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <li>☑️ Pembimbing bersertifikasi</li>
                                <li>☑️ Setoran hafalan mingguan</li>
                                <li>☑️ Catatan progres mingguan</li>
                            </ul>
                        </div>
                        <div class="rounded-3xl border border-gray-100 p-6 shadow-sm bg-white/80">
                            <p class="text-xs uppercase tracking-[0.3em] text-indigo-500 font-semibold">Level Lanjutan</p>
                            <h3 class="mt-2 text-xl font-semibold text-gray-900">Pembinaan Akhlak</h3>
                            <p class="mt-3 text-gray-600">Kajian adab, fiqh ibadah dasar, praktik dakwah kecil, dan pengembangan kepemimpinan santri.</p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <li>☑️ Kegiatan mentoring bulanan</li>
                                <li>☑️ Proyek sosial TPQ</li>
                                <li>☑️ Laporan karakter santri</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section id="pengajar" class="py-16 bg-gradient-to-r from-indigo-600 to-purple-500 text-white">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div>
                            <p class="text-sm uppercase tracking-[0.3em] font-semibold text-indigo-200">Tenaga Pengajar</p>
                            <h2 class="mt-2 text-3xl font-bold">Tim Ustadz & Ustadzah Berpengalaman</h2>
                            <p class="mt-3 text-indigo-100">Setiap pengajar melalui proses seleksi ketat dan pelatihan rutin untuk memastikan kualitas pengajaran Al-Qur'an yang unggul.</p>
                        </div>
                        <div class="flex gap-6">
                            <div>
                                <p class="text-4xl font-bold">15</p>
                                <p class="text-sm text-indigo-100">Pengajar Aktif</p>
                            </div>
                            <div>
                                <p class="text-4xl font-bold">5+</p>
                                <p class="text-sm text-indigo-100">Pelatihan Tahunan</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 grid gap-6 md:grid-cols-3">
                        <div class="bg-white/10 backdrop-blur rounded-3xl p-6 border border-white/20">
                            <p class="text-xl font-semibold">Ust. Ahmad Fauzi</p>
                            <p class="text-sm text-indigo-100 mt-1">Koordinator Tahfidz</p>
                            <p class="mt-3 text-sm text-indigo-100">Lulusan Ma'had Tahfidz Internasional, pengalaman 8 tahun membimbing santri menghafal Al-Qur'an.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-3xl p-6 border border-white/20">
                            <p class="text-xl font-semibold">Ustzh. Fatimah Zahra</p>
                            <p class="text-sm text-indigo-100 mt-1">Pembina Akhlak</p>
                            <p class="mt-3 text-sm text-indigo-100">Fokus pada pembinaan karakter, adab ibadah, dan pendampingan santri perempuan.</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-3xl p-6 border border-white/20">
                            <p class="text-xl font-semibold">Ust. Ridho Mubarok</p>
                            <p class="text-sm text-indigo-100 mt-1">Koordinator Tahsin</p>
                            <p class="mt-3 text-sm text-indigo-100">Sertifikasi qiroat sab'ah, ahli dalam perbaikan bacaan dan pembinaan tajwid tingkat lanjut.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="kegiatan" class="py-16">
                <div class="max-w-7xl mx-auto px-6">
                    <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold text-center">Kegiatan Santri</p>
                    <h2 class="mt-4 text-3xl font-bold text-center text-gray-900">Ragam Aktivitas yang Menguatkan Iman dan Akhlak</h2>
                    <div class="mt-10 grid gap-6 md:grid-cols-3">
                        <div class="rounded-3xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=800&q=80" alt="Muroja'ah bersama" class="h-48 w-full object-cover">
                            <div class="bg-white p-6">
                                <p class="text-sm text-indigo-600 font-semibold">Setiap pekan</p>
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Muroja'ah Bersama</h3>
                                <p class="mt-2 text-gray-600">Kegiatan rutin untuk memperkuat hafalan, saling menyimak, dan belajar dari satu sama lain.</p>
                            </div>
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80" alt="Pesantren kilat" class="h-48 w-full object-cover">
                            <div class="bg-white p-6">
                                <p class="text-sm text-indigo-600 font-semibold">Ramadhan</p>
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Pesantren Kilat & Lomba</h3>
                                <p class="mt-2 text-gray-600">Serangkaian perlombaan islami, kajian tematik, dan pembinaan akhlak selama bulan suci.</p>
                            </div>
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80" alt="Parenting class" class="h-48 w-full object-cover">
                            <div class="bg-white p-6">
                                <p class="text-sm text-indigo-600 font-semibold">Kolaborasi</p>
                                <h3 class="mt-2 text-xl font-semibold text-gray-900">Parenting Class</h3>
                                <p class="mt-2 text-gray-600">Kegiatan untuk wali santri guna menyelaraskan metode pendidikan di rumah dan TPQ.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="pendaftaran" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-6 grid gap-8 md:grid-cols-2 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Pendaftaran Santri Baru</p>
                        <h2 class="mt-4 text-3xl font-bold text-gray-900">Bergabung bersama keluarga besar TPQ Nurul Hikmah</h2>
                        <p class="mt-4 text-gray-600">Kami membuka pendaftaran sepanjang tahun untuk anak usia 4–15 tahun. Dapatkan pengalaman belajar Al-Qur'an yang menyenangkan dan terpantau.</p>
                        <ul class="mt-6 space-y-3 text-gray-700">
                            <li>📌 Gelombang pendaftaran setiap awal bulan</li>
                            <li>📌 Persyaratan: fotokopi akta lahir & KK, pas foto, dan form pendaftaran</li>
                            <li>📌 Beasiswa khusus bagi santri berprestasi dan yatim</li>
                        </ul>
                        <div class="mt-6 flex gap-3">
                            <a href="https://wa.me/6281234567890" class="inline-flex items-center justify-center rounded-xl bg-green-600 px-5 py-3 text-white font-semibold shadow hover:-translate-y-0.5 transition">Hubungi Admin</a>
                            <a href="#kontak" class="inline-flex items-center justify-center rounded-xl border border-gray-200 px-5 py-3 text-gray-700 font-semibold hover:bg-gray-50 transition">Kunjungi TPQ</a>
                        </div>
                    </div>
                    <div class="rounded-3xl bg-gradient-to-br from-indigo-600 to-purple-500 text-white p-8 shadow-2xl">
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-200 font-semibold">Testimoni Wali</p>
                        <p class="mt-4 text-2xl font-semibold">"Anak kami kini lebih semangat mengaji dan memahami doa sehari-hari. Laporan perkembangan yang dikirim TPQ membuat kami tenang."</p>
                        <p class="mt-6 text-sm font-semibold text-indigo-100">– Wali Santri Ananda Zahra</p>
                        <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-3xl font-bold text-white">95%</p>
                                <p class="text-indigo-100">Orang tua puas terhadap layanan TPQ</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white">4.8/5</p>
                                <p class="text-indigo-100">Rating kepuasan program belajar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="kontak" class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-6 grid gap-10 md:grid-cols-2">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-600 font-semibold">Lokasi & Kontak</p>
                        <h2 class="mt-4 text-3xl font-bold text-gray-900">Kunjungi TPQ Nurul Hikmah</h2>
                        <p class="mt-4 text-gray-600">Jl. Melati No. 12, Desa Harmoni, Kecamatan Sejahtera. Kami siap menyambut Anda setiap hari Senin–Sabtu pukul 08.00–17.00.</p>
                        <div class="mt-6 space-y-4 text-gray-700">
                            <p>📞 0812-3456-7890</p>
                            <p>📧 admin@tpq-nurulhikmah.id</p>
                            <p>🌐 www.tpq-nurulhikmah.id</p>
                        </div>
                        <div class="mt-6 flex gap-3">
                            <a href="https://www.instagram.com" class="inline-flex items-center justify-center rounded-full bg-white shadow px-4 py-2 text-indigo-600 font-semibold">Instagram</a>
                            <a href="https://www.youtube.com" class="inline-flex items-center justify-center rounded-full bg-white shadow px-4 py-2 text-indigo-600 font-semibold">YouTube</a>
                        </div>
                    </div>
                    <div class="rounded-3xl overflow-hidden border border-white/70 shadow-lg">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.0568431564025!2d110.4144994!3d-7.891634299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5718fffffff%3A0xabcdef123456789!2sTPQ%20Nurul%20Hikmah!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" class="w-full h-80" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </section>

            <footer class="bg-white border-t border-gray-100">
                <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} TPQ Nurul Hikmah. All rights reserved.</p>
                    <div class="flex gap-4 mt-4 md:mt-0">
                        <a href="#" class="hover:text-indigo-600">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-indigo-600">Syarat & Ketentuan</a>
                        <a href="mailto:admin@tpq-nurulhikmah.id" class="hover:text-indigo-600">Kontak</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
