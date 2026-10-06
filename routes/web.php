<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\SholatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RobloxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Project JSON / Portal Islami Nurul Qur'an
|--------------------------------------------------------------------------
*/

// Beranda Utama Portal Islami (eQuran.id LKPD)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Layanan 01: Al-Qur'an (Surat, Ayat, Audio 6 Qari, & Tafsir)
Route::prefix('quran')->name('quran.')->group(function () {
    Route::get('/', [QuranController::class, 'index'])->name('index');
    Route::get('/surat/{nomor}', [QuranController::class, 'show'])->whereNumber('nomor')->name('show');
    Route::get('/{nomor}', [QuranController::class, 'show'])->whereNumber('nomor'); // alias untuk kompatibilitas resource
});

// Layanan 02: Doa Harian (Daftar, Filter Tag, Detail & Sumber Hadits)
Route::prefix('doa')->name('doa.')->group(function () {
    Route::get('/', [DoaController::class, 'index'])->name('index');
    Route::get('/{id}', [DoaController::class, 'show'])->whereNumber('id')->name('show');
});

// Layanan 03: Jadwal Sholat (Pilihan Provinsi, Kab/Kota, Bulan, Tahun - GET & POST)
Route::prefix('jadwal-sholat')->name('sholat.')->group(function () {
    Route::get('/', [SholatController::class, 'index'])->name('index');
    Route::post('/', [SholatController::class, 'index'])->name('filter');
    Route::post('/kabkota', [SholatController::class, 'getKabkotaAjax'])->name('kabkota.ajax');
    Route::post('/jadwal', [SholatController::class, 'getJadwalAjax'])->name('jadwal.ajax');
});

// Lembar Kerja Peserta Didik (LKPD) & Laporan Proyek
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');


/*
|--------------------------------------------------------------------------
| Rute Pembelajaran API Lainnya (Quote, Roblox, Produk Dummy)
|--------------------------------------------------------------------------
*/
Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes');
Route::resource('/quotes-api', QuoteController::class);

Route::get('/roblox', [RobloxController::class, 'index'])->name('roblox');

Route::get('/produk', function () {
    return response()->json([
        [
            "id" => 1,
            "nama" => "buku lima sekawan",
            "harga" => 50000,
            "stok" => 10,
        ],
        [
            "id" => 2,
            "nama" => "buku MTK",
            "harga" => 40000,
            "stok" => 8,
        ],
        [
            "id" => 3,
            "nama" => "buku PAI",
            "harga" => 55000,
            "stok" => 6,
        ],
    ]);
});

Route::get('/produk/{id}', function ($id) {
    $produk = [
        1 => [
            "id" => 1,
            "nama" => "buku lima sekawan",
            "harga" => 50000,
            "stok" => 10,
        ],
        2 => [
            "id" => 2,
            "nama" => "buku MTK",
            "harga" => 40000,
            "stok" => 8,
        ],
        3 => [
            "id" => 3,
            "nama" => "buku PAI",
            "harga" => 55000,
            "stok" => 6,
        ],
    ];

    if (isset($produk[$id])) {
        return response()->json($produk[$id]);
    } else {
        return response()->json(['message' => 'Produk tidak ditemukan'], 404);
    }
});