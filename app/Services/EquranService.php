<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EquranService
{
    protected string $baseUrl = 'https://equran.id/api';
    protected int $cacheTtl = 86400; // 24 jam cache default

    /**
     * Mengambil seluruh daftar surat dari API v2
     */
    public function getDaftarSurat(): array
    {
        return Cache::remember('equran_daftar_surat', $this->cacheTtl, function () {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/v2/surat");

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Gagal mengambil data surat: ' . $response->status(),
                    'data' => []
                ];
            } catch (\Throwable $e) {
                Log::error('EquranService getDaftarSurat error: ' . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Koneksi ke API eQuran gagal: ' . $e->getMessage(),
                    'data' => []
                ];
            }
        });
    }

    /**
     * Mengambil detail surat beserta seluruh ayat & audio
     */
    public function getDetailSurat(int|string $nomor): array
    {
        return Cache::remember("equran_surat_{$nomor}", $this->cacheTtl, function () use ($nomor) {
            try {
                $response = Http::timeout(12)->get("{$this->baseUrl}/v2/surat/{$nomor}");

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Surat tidak ditemukan atau server eQuran sedang sibuk.',
                    'data' => null
                ];
            } catch (\Throwable $e) {
                Log::error("EquranService getDetailSurat {$nomor} error: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memuat surat: ' . $e->getMessage(),
                    'data' => null
                ];
            }
        });
    }

    /**
     * Mengambil tafsir lengkap surat berdasarkan nomor
     */
    public function getTafsirSurat(int|string $nomor): array
    {
        return Cache::remember("equran_tafsir_{$nomor}", $this->cacheTtl, function () use ($nomor) {
            try {
                $response = Http::timeout(12)->get("{$this->baseUrl}/v2/tafsir/{$nomor}");

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Tafsir surat tidak ditemukan.',
                    'data' => null
                ];
            } catch (\Throwable $e) {
                Log::error("EquranService getTafsirSurat {$nomor} error: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Gagal mengambil tafsir: ' . $e->getMessage(),
                    'data' => null
                ];
            }
        });
    }

    /**
     * Mengambil daftar doa harian
     */
    public function getDoaHarian(): array
    {
        return Cache::remember('equran_doa_harian', $this->cacheTtl, function () {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/doa");

                if ($response->successful()) {
                    $json = $response->json();
                    $data = $json['data'] ?? [];
                    return [
                        'success' => true,
                        'data' => $data
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Gagal mengambil data kumpulan doa.',
                    'data' => []
                ];
            } catch (\Throwable $e) {
                Log::error('EquranService getDoaHarian error: ' . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Koneksi ke API Doa gagal: ' . $e->getMessage(),
                    'data' => []
                ];
            }
        });
    }

    /**
     * Mengambil daftar provinsi untuk jadwal shalat (GET /api/v2/shalat/provinsi)
     */
    public function getProvinsi(): array
    {
        return Cache::remember('equran_shalat_provinsi', $this->cacheTtl, function () {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/v2/shalat/provinsi");

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Gagal mengambil daftar provinsi.',
                    'data' => []
                ];
            } catch (\Throwable $e) {
                Log::error('EquranService getProvinsi error: ' . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Gagal terhubung ke data provinsi: ' . $e->getMessage(),
                    'data' => []
                ];
            }
        });
    }

    /**
     * Mengambil daftar kabupaten/kota untuk provinsi tertentu (POST /api/v2/shalat/kabkota)
     */
    public function getKabkota(string $provinsi): array
    {
        $cacheKey = 'equran_kabkota_' . md5($provinsi);

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($provinsi) {
            try {
                $response = Http::timeout(10)
                    ->asJson()
                    ->post("{$this->baseUrl}/v2/shalat/kabkota", [
                        'provinsi' => $provinsi
                    ]);

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Gagal mengambil data kabupaten/kota.',
                    'data' => []
                ];
            } catch (\Throwable $e) {
                Log::error("EquranService getKabkota for {$provinsi} error: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Koneksi API kab/kota gagal: ' . $e->getMessage(),
                    'data' => []
                ];
            }
        });
    }

    /**
     * Mengambil jadwal shalat bulanan (POST /api/v2/shalat)
     */
    public function getJadwalShalat(string $provinsi, string $kabkota, int $bulan, int $tahun): array
    {
        $cacheKey = "equran_jadwal_" . md5("{$provinsi}_{$kabkota}_{$bulan}_{$tahun}");

        return Cache::remember($cacheKey, 3600 * 6, function () use ($provinsi, $kabkota, $bulan, $tahun) {
            try {
                $response = Http::timeout(10)
                    ->asJson()
                    ->post("{$this->baseUrl}/v2/shalat", [
                        'provinsi' => $provinsi,
                        'kabkota' => $kabkota,
                        'bulan' => $bulan,
                        'tahun' => $tahun
                    ]);

                if ($response->successful()) {
                    return [
                        'success' => true,
                        'data' => $response->json('data') ?? []
                    ];
                }

                return [
                    'success' => false,
                    'message' => $response->json('message') ?? 'Gagal mengambil jadwal sholat.',
                    'data' => null
                ];
            } catch (\Throwable $e) {
                Log::error("EquranService getJadwalShalat error: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Koneksi API jadwal shalat gagal: ' . $e->getMessage(),
                    'data' => null
                ];
            }
        });
    }
}
