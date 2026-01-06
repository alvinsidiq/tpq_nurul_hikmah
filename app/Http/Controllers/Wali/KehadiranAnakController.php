<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KehadiranAnakController extends Controller
{
    public function index(Request $request)
    {
        $waliId = auth()->id();
        $anak = Santri::where('wali_user_id', $waliId)->orderBy('nama_lengkap')->get();

        $santriId = (int) optional($anak->first())->id;

        $bulan = $request->get('bulan') ?: now()->format('Y-m'); // format YYYY-MM
        $start = Carbon::createFromFormat('Y-m-d', $bulan.'-01')->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $q = Kehadiran::query()->whereHas('santri', function ($w) use ($waliId) {
            $w->where('wali_user_id', $waliId);
        });
        if ($santriId) {
            $q->where('santri_id', $santriId);
        }
        $q->whereBetween('tanggal', [$start->toDateString(), $end->toDateString()]);

        $items = $q->orderByDesc('tanggal')->paginate(30)->withQueryString();

        $total = (clone $q)->count();
        $hadir = (clone $q)->where('status','H')->count();
        $persen = $total > 0 ? round($hadir / $total * 100) : 0;

        $ringkasan = [
            'total' => $total,
            'hadir' => $hadir,
            'izin' => (clone $q)->where('status','I')->count(),
            'sakit' => (clone $q)->where('status','S')->count(),
            'alpa' => (clone $q)->where('status','A')->count(),
            'persentase' => $persen,
            'periode' => [$start->toDateString(), $end->toDateString()],
        ];

        return view('wali.kehadiran.index', compact('anak','items','ringkasan','santriId','bulan'));
    }
}
