<?php

namespace App\Http\Controllers;

use App\Services\EquranService;
use Illuminate\Http\Request;

class SholatController extends Controller
{
    public function __construct(protected EquranService $equranService)
    {
    }

    public function index(Request $request)
    {
        $provinsiResult = $this->equranService->getProvinsi();
        $daftarProvinsi = $provinsiResult['data'] ?? [];

        // Parameter default atau dari request
        $selectedProvinsi = $request->input('provinsi', 'Jawa Barat');
        if (!in_array($selectedProvinsi, $daftarProvinsi) && !empty($daftarProvinsi)) {
            $selectedProvinsi = $daftarProvinsi[0];
        }

        // Ambil daftar kabkota untuk provinsi terpilih
        $kabkotaResult = $this->equranService->getKabkota($selectedProvinsi);
        $daftarKabkota = $kabkotaResult['data'] ?? [];

        $selectedKabkota = $request->input('kabkota', 'Kota Bogor');
        if (!in_array($selectedKabkota, $daftarKabkota) && !empty($daftarKabkota)) {
            $selectedKabkota = $daftarKabkota[0];
        }

        $selectedBulan = (int)$request->input('bulan', date('n'));
        $selectedTahun = (int)$request->input('tahun', date('Y'));

        // Ambil jadwal shalat
        $jadwalResult = $this->equranService->getJadwalShalat(
            $selectedProvinsi,
            $selectedKabkota,
            $selectedBulan,
            $selectedTahun
        );

        $jadwalData = $jadwalResult['data'] ?? null;
        $isSuccess = $jadwalResult['success'];
        $errorMessage = $jadwalResult['message'] ?? null;

        $daftarBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('sholat.index', compact(
            'daftarProvinsi',
            'daftarKabkota',
            'selectedProvinsi',
            'selectedKabkota',
            'selectedBulan',
            'selectedTahun',
            'daftarBulan',
            'jadwalData',
            'isSuccess',
            'errorMessage'
        ));
    }

    /**
     * AJAX endpoint untuk mendapatkan list kabkota berdasarkan provinsi
     */
    public function getKabkotaAjax(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|string'
        ]);

        $res = $this->equranService->getKabkota($request->provinsi);
        return response()->json($res);
    }

    /**
     * AJAX endpoint untuk mendapatkan jadwal sholat
     */
    public function getJadwalAjax(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|string',
            'kabkota' => 'required|string',
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric'
        ]);

        $res = $this->equranService->getJadwalShalat(
            $request->provinsi,
            $request->kabkota,
            (int)$request->bulan,
            (int)$request->tahun
        );

        return response()->json($res);
    }
}
