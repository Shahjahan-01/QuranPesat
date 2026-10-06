<?php

namespace App\Http\Controllers;

use App\Services\EquranService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected EquranService $equranService)
    {
    }

    public function index()
    {
        $suratResult = $this->equranService->getDaftarSurat();
        $allSurat = $suratResult['data'] ?? [];

        // Pilihan surat populer untuk quick access
        $populerNomor = [1, 18, 36, 55, 56, 67]; // Al-Fatihah, Al-Kahfi, Yasin, Ar-Rahman, Al-Waqi'ah, Al-Mulk
        $suratPopuler = array_filter($allSurat, fn($s) => in_array($s['nomor'], $populerNomor));

        // Ambil beberapa doa untuk ditampilkan di beranda
        $doaResult = $this->equranService->getDoaHarian();
        $allDoa = $doaResult['data'] ?? [];
        $doaPilihan = !empty($allDoa) ? array_slice($allDoa, 0, 4) : [];

        // Ambil jadwal shalat hari ini untuk default kota
        $provinsi = 'Jawa Barat';
        $kabkota = 'Kota Bogor';
        $bulan = (int)date('m');
        $tahun = (int)date('Y');
        $jadwalResult = $this->equranService->getJadwalShalat($provinsi, $kabkota, $bulan, $tahun);
        $jadwalData = $jadwalResult['data'] ?? null;

        $hariIni = (int)date('j');
        $jadwalHariIni = null;
        if ($jadwalData && isset($jadwalData['jadwal'])) {
            foreach ($jadwalData['jadwal'] as $j) {
                if ($j['tanggal'] == $hariIni) {
                    $jadwalHariIni = $j;
                    break;
                }
            }
        }

        return view('home', compact('suratPopuler', 'doaPilihan', 'jadwalHariIni', 'provinsi', 'kabkota', 'suratResult'));
    }
}
