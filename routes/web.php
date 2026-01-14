<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'throttle:60,1'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

// Post-login redirect router
Route::middleware(['auth','verified'])->get('/post-login', function () {
    $user = auth()->user();
    return match (true) {
        $user->hasRole('admin') => redirect()->route('admin.dashboard'),
        $user->hasRole('guru') => redirect()->route('guru.dashboard'),
        $user->hasRole('wali_santri') => redirect()->route('wali.dashboard'),
        default => redirect()->route('dashboard'),
    };
})->name('post-login');

// Role-specific dashboards
Route::middleware(['auth','verified','role:admin'])->group(function(){
    Route::view('/admin','dashboards.admin')->name('admin.dashboard');
});
Route::middleware(['auth','verified','role:admin|guru'])->group(function(){
    Route::view('/guru','dashboards.guru')->name('guru.dashboard');
    Route::name('guru.')->prefix('guru')->group(function(){
        Route::resource('kelas', \App\Http\Controllers\Guru\KelasSayaController::class)->only(['index','show']);
        // Kehadiran
        Route::get('kehadiran', [\App\Http\Controllers\Guru\KehadiranController::class, 'index'])->name('kehadiran.index');
        Route::get('kehadiran/harian/{kelas}', [\App\Http\Controllers\Guru\KehadiranController::class, 'daily'])->name('kehadiran.daily');
        Route::get('kehadiran/kelas/{kelas}', [\App\Http\Controllers\Guru\KehadiranController::class, 'form'])->name('kehadiran.form');
        Route::post('kehadiran/kelas/{kelas}', [\App\Http\Controllers\Guru\KehadiranController::class, 'store'])->name('kehadiran.store');

        // Nilai
        Route::get('nilai', [\App\Http\Controllers\Guru\NilaiController::class, 'index'])->name('nilai.index');
        Route::get('nilai/kelas/{kelas}', [\App\Http\Controllers\Guru\NilaiController::class, 'form'])->name('nilai.form');
        Route::post('nilai/kelas/{kelas}', [\App\Http\Controllers\Guru\NilaiController::class, 'store'])->name('nilai.store');

        // Kenaikan Jilid
        Route::get('kenaikan-jilid', [\App\Http\Controllers\Guru\KenaikanJilidController::class, 'index'])->name('kenaikan.index');
    });
});
Route::middleware(['auth','verified','role:wali_santri'])->group(function(){
    Route::view('/wali','dashboards.wali')->name('wali.dashboard');
    Route::name('wali.')->prefix('wali')->group(function(){
        Route::get('nilai', [\App\Http\Controllers\Wali\NilaiAnakController::class,'index'])->name('nilai.index');
        Route::get('kehadiran', [\App\Http\Controllers\Wali\KehadiranAnakController::class,'index'])->name('kehadiran.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin: User management
Route::middleware(['auth','verified','role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{user}/reset-password', [\App\Http\Controllers\Admin\UserController::class,'resetPassword'])
        ->name('users.reset-password');

    // Akademik
    Route::resource('ta', \App\Http\Controllers\Admin\TahunAjaranController::class);
    Route::resource('mapel', \App\Http\Controllers\Admin\MataPelajaranController::class);
    Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);

    Route::resource('semesters', \App\Http\Controllers\Admin\SemesterController::class);

    // Data Santri
    Route::resource('santri', \App\Http\Controllers\Admin\SantriController::class);
    
    // Kegiatan TPQ
    Route::post('kegiatan/{kegiatan}/notify', [\App\Http\Controllers\Admin\KegiatanController::class, 'notify'])->name('kegiatan.notify');
    Route::resource('kegiatan', \App\Http\Controllers\Admin\KegiatanController::class);

    // Jadwal
    Route::resource('jadwal', \App\Http\Controllers\Admin\JadwalController::class);

    // Laporan
    Route::get('reports/kehadiran', [\App\Http\Controllers\Admin\ReportController::class, 'kehadiran'])->name('reports.kehadiran');
    Route::get('reports/nilai', [\App\Http\Controllers\Admin\ReportController::class, 'nilai'])->name('reports.nilai');
    Route::get('reports/rekap-kelas', [\App\Http\Controllers\Admin\ReportController::class, 'rekapKelas'])->name('reports.rekap-kelas');
});
