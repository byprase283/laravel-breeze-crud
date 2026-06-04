<?php

namespace App\Http\Controllers;

use App\Services\JadwalService;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    protected $jadwalService;

    public function __construct(JadwalService $jadwalService)
    {
        $this->jadwalService = $jadwalService;
    }

    public function index(Request $request)
    {
        // Ambil semua data dari service
        $allJadwal = $this->jadwalService->getJadwal();

        // Fitur Pencarian & Filter Sederhana (opsional namun sangat berguna)
        $search = $request->input('search');
        $prodiFilter = $request->input('prodi');

        $filteredJadwal = collect($allJadwal);

        if ($search) {
            $filteredJadwal = $filteredJadwal->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['mata_kuliah']['nama']), strtolower($search)) ||
                    str_contains(strtolower($item['dosen']['nama']), strtolower($search));
            });
        }

        if ($prodiFilter) {
            $filteredJadwal = $filteredJadwal->filter(function ($item) use ($prodiFilter) {
                return $item['prodi'] === $prodiFilter;
            });
        }

        // Daftar prodi unik untuk dropdown filter
        $daftarProdi = collect($allJadwal)->pluck('prodi')->unique();

        // Helper untuk konversi kode hari
        $hariMap = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        return view('jadwal.index', [
            'jadwal' => $filteredJadwal,
            'daftarProdi' => $daftarProdi,
            'hariMap' => $hariMap,
        ]);
    }
}
