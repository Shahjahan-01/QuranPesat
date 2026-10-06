<?php

namespace App\Http\Controllers;

use App\Services\EquranService;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    public function __construct(protected EquranService $equranService)
    {
    }

    public function index(Request $request)
    {
        $result = $this->equranService->getDoaHarian();
        $allDoa = $result['data'] ?? [];

        // Kumpulkan semua kategori/tag unik
        $allTags = [];
        $allGrup = [];
        foreach ($allDoa as $item) {
            if (!empty($item['tag']) && is_array($item['tag'])) {
                foreach ($item['tag'] as $t) {
                    $allTags[$t] = ($allTags[$t] ?? 0) + 1;
                }
            }
            if (!empty($item['grup'])) {
                $allGrup[$item['grup']] = true;
            }
        }
        arsort($allTags);

        $search = $request->query('q', '');
        $selectedTag = $request->query('tag', '');
        $selectedGrup = $request->query('grup', '');

        $filteredDoa = $allDoa;

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $filteredDoa = array_filter($filteredDoa, function ($d) use ($searchLower) {
                return str_contains(strtolower($d['nama'] ?? ''), $searchLower)
                    || str_contains(strtolower($d['idn'] ?? ''), $searchLower)
                    || str_contains(strtolower($d['tr'] ?? ''), $searchLower)
                    || str_contains(strtolower($d['tentang'] ?? ''), $searchLower);
            });
        }

        if (!empty($selectedTag)) {
            $filteredDoa = array_filter($filteredDoa, function ($d) use ($selectedTag) {
                return !empty($d['tag']) && is_array($d['tag']) && in_array($selectedTag, $d['tag']);
            });
        }

        if (!empty($selectedGrup)) {
            $filteredDoa = array_filter($filteredDoa, function ($d) use ($selectedGrup) {
                return ($d['grup'] ?? '') === $selectedGrup;
            });
        }

        return view('doa.index', [
            'doaList' => $filteredDoa,
            'allTags' => array_keys($allTags),
            'allGrup' => array_keys($allGrup),
            'selectedTag' => $selectedTag,
            'selectedGrup' => $selectedGrup,
            'search' => $search,
            'totalSemua' => count($allDoa),
            'totalDitemukan' => count($filteredDoa),
            'isSuccess' => $result['success'],
            'errorMessage' => $result['message'] ?? null
        ]);
    }

    public function show(int $id)
    {
        $result = $this->equranService->getDoaHarian();
        $allDoa = $result['data'] ?? [];

        $doa = null;
        foreach ($allDoa as $item) {
            if (($item['id'] ?? 0) == $id) {
                $doa = $item;
                break;
            }
        }

        if (!$doa) {
            return view('doa.not_found', ['id' => $id]);
        }

        // Ambil doa terkait dengan tag yang sama
        $doaTerkait = [];
        if (!empty($doa['tag']) && is_array($doa['tag'])) {
            $firstTag = $doa['tag'][0];
            $doaTerkait = array_slice(array_filter($allDoa, function ($d) use ($firstTag, $id) {
                return ($d['id'] ?? 0) != $id && !empty($d['tag']) && in_array($firstTag, $d['tag']);
            }), 0, 3);
        }

        return view('doa.show', compact('doa', 'doaTerkait'));
    }
}
