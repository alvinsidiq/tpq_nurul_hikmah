<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KenaikanJilidController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $kelasOptions = Kelas::query()
            ->when(!$user->hasRole('admin'), fn ($q) => $q->where('guru_id', $user->id))
            ->orderBy('nama_kelas')
            ->pluck('nama_kelas', 'id');
        $semesterOptions = Semester::orderByDesc('tanggal_mulai')->pluck('nama', 'id');
        $tahunAjaranOptions = TahunAjaran::orderByDesc('tanggal_mulai')->pluck('nama', 'id');

        $kelasId = (int) $request->query('kelas_id');
        if (!$kelasId || !$kelasOptions->has($kelasId)) {
            $kelasId = (int) $kelasOptions->keys()->first();
        }
        $semesterId = (int) $request->query('semester_id');
        if (!$semesterId || !$semesterOptions->has($semesterId)) {
            $semesterId = (int) $semesterOptions->keys()->first();
        }
        $tahunAjaranId = (int) $request->query('tahun_ajaran_id');
        if (!$tahunAjaranId || !$tahunAjaranOptions->has($tahunAjaranId)) {
            $tahunAjaranId = (int) $tahunAjaranOptions->keys()->first();
        }

        $jenisPenilaian = Nilai::jenisPenilaianOptions();
        $bobot = Nilai::bobotPenilaian();
        $ambangNaik = Nilai::ambangNaik();

        $rekap = collect();
        $mapelCount = 0;

        if ($kelasId && $semesterId && $tahunAjaranId) {
            $santris = Santri::where('kelas_id', $kelasId)->orderBy('nama_lengkap')->get();
            $mapelIds = Jadwal::where('kelas_id', $kelasId)
                ->pluck('mata_pelajaran_id')
                ->unique()
                ->values();
            $mapelCount = $mapelIds->count();

            $nilaiRows = collect();
            if ($santris->isNotEmpty() && $mapelCount > 0) {
                $nilaiRows = Nilai::query()
                    ->whereIn('santri_id', $santris->pluck('id'))
                    ->whereIn('mata_pelajaran_id', $mapelIds)
                    ->where('semester_id', $semesterId)
                    ->where('tahun_ajaran_id', $tahunAjaranId)
                    ->whereIn('jenis_penilaian', array_keys($jenisPenilaian))
                    ->select('santri_id', 'mata_pelajaran_id', 'jenis_penilaian', DB::raw('AVG(skor) as avg_skor'))
                    ->groupBy('santri_id', 'mata_pelajaran_id', 'jenis_penilaian')
                    ->get();
            }

            $nilaiMap = [];
            foreach ($nilaiRows as $row) {
                $nilaiMap[$row->santri_id][$row->mata_pelajaran_id][$row->jenis_penilaian] = (float) $row->avg_skor;
            }

            $jenisKeys = array_keys($jenisPenilaian);

            $rekap = $santris->map(function ($santri) use ($mapelIds, $mapelCount, $jenisKeys, $nilaiMap, $bobot, $ambangNaik) {
                $finalScores = [];
                $completedMapel = 0;

                foreach ($mapelIds as $mapelId) {
                    $totalWeight = 0;
                    $totalScore = 0;
                    $hasAllTypes = true;

                    foreach ($jenisKeys as $jenis) {
                        $score = $nilaiMap[$santri->id][$mapelId][$jenis] ?? null;
                        if ($score === null) {
                            $hasAllTypes = false;
                            continue;
                        }

                        $weight = $bobot[$jenis] ?? 0;
                        if ($weight > 0) {
                            $totalScore += $score * $weight;
                            $totalWeight += $weight;
                        }
                    }

                    $final = $totalWeight > 0 ? $totalScore / $totalWeight : null;
                    if ($hasAllTypes && $final !== null) {
                        $completedMapel++;
                    }
                    if ($final !== null) {
                        $finalScores[] = $final;
                    }
                }

                $nilaiAkhir = count($finalScores) > 0 ? array_sum($finalScores) / count($finalScores) : null;

                if ($mapelCount === 0) {
                    $status = 'Belum ada mapel';
                } elseif ($completedMapel < $mapelCount) {
                    $status = 'Belum Lengkap';
                } elseif ($nilaiAkhir === null) {
                    $status = 'Belum Ada Nilai';
                } elseif ($nilaiAkhir >= $ambangNaik) {
                    $status = 'Layak Naik';
                } else {
                    $status = 'Perlu Pembinaan';
                }

                return [
                    'santri' => $santri,
                    'nilai_akhir' => $nilaiAkhir,
                    'mapel_total' => $mapelCount,
                    'mapel_complete' => $completedMapel,
                    'status' => $status,
                ];
            });
        }

        return view('guru.kenaikan.index', [
            'kelasOptions' => $kelasOptions,
            'semesterOptions' => $semesterOptions,
            'tahunAjaranOptions' => $tahunAjaranOptions,
            'kelasId' => $kelasId,
            'semesterId' => $semesterId,
            'tahunAjaranId' => $tahunAjaranId,
            'jenisPenilaian' => $jenisPenilaian,
            'bobot' => $bobot,
            'ambangNaik' => $ambangNaik,
            'rekap' => $rekap,
            'mapelCount' => $mapelCount,
        ]);
    }
}
