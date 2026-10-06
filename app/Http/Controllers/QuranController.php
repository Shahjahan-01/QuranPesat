<?php

namespace App\Http\Controllers;

use App\Services\EquranService;
use Illuminate\Http\Request;

class QuranController extends Controller
{
    public function __construct(protected EquranService $equranService)
    {
    }

    /**
     * Menampilkan seluruh 114 surat Al-Qur'an dengan pencarian & filter
     */
    public function index(Request $request)
    {
        $result = $this->equranService->getDaftarSurat();
        $suratList = $result['data'] ?? [];
        $search = $request->query('q', '');
        $tempatTurun = $request->query('tempat', '');

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $suratList = array_filter($suratList, function ($s) use ($searchLower) {
                return str_contains(strtolower($s['namaLatin'] ?? ''), $searchLower)
                    || str_contains(strtolower($s['arti'] ?? ''), $searchLower)
                    || str_contains((string)($s['nomor'] ?? ''), $searchLower);
            });
        }

        if (!empty($tempatTurun)) {
            $suratList = array_filter($suratList, function ($s) use ($tempatTurun) {
                return strtolower($s['tempatTurun'] ?? '') === strtolower($tempatTurun);
            });
        }

        return view('quran.index', [
            'quran' => $suratList, // kompatibel dengan variable lama $quran
            'suratList' => $suratList,
            'search' => $search,
            'tempatTurun' => $tempatTurun,
            'isSuccess' => $result['success'],
            'errorMessage' => $result['message'] ?? null
        ]);
    }

    /**
     * Menampilkan detail surat lengkap, audio 6 qari, audio per ayat & tafsir Kemenag RI
     */
    public function show(string $nomor)
    {
        $nomorInt = (int)$nomor;
        if ($nomorInt < 1 || $nomorInt > 114) {
            abort(404, 'Surat tidak ditemukan');
        }

        $suratResult = $this->equranService->getDetailSurat($nomorInt);
        $tafsirResult = $this->equranService->getTafsirSurat($nomorInt);

        if (!$suratResult['success'] || empty($suratResult['data'])) {
            return view('quran.show_error', [
                'nomor' => $nomorInt,
                'message' => $suratResult['message'] ?? 'Surat gagal dimuat.'
            ]);
        }

        $surat = $suratResult['data'];
        $tafsir = $tafsirResult['data'] ?? null;

        // Daftar 6 Qari terkemuka dari eQuran.id
        $qariList = [
            '01' => 'Abdullah Al-Juhany',
            '02' => 'Abdul Muhsin Al-Qasim',
            '03' => 'Abdurrahman As-Sudais',
            '04' => 'Ibrahim Al-Dossari',
            '05' => 'Misyari Rasyid Al-Afasi',
            '06' => 'Yasser Al-Dosari'
        ];

        return view('quran.show', [
            'quran' => $surat, // kompatibel dengan variable lama $quran
            'surat' => $surat,
            'tafsir' => $tafsir,
            'qariList' => $qariList,
            'nomor' => $nomorInt
        ]);
    }
}
