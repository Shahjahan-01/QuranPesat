# Nurul Qur'an - Portal Al-Qur'an, Doa Harian & Jadwal Sholat

Aplikasi Web Islami modern berbasis **Laravel 12** yang mengintegrasikan layanan resmi **eQuran.id API v2**. Dibuat untuk memenuhi tugas **Lembar Kerja Peserta Didik (LKPD) Rekayasa Perangkat Lunak (RPL)** dengan standar desain islami profesional, berwibawa, dan elegan.

---

## 🌟 Fitur Utama (3 Layanan Lengkap)

### 1. Al-Qur'an & Tafsir Kemenag RI
- **114 Surat Lengkap:** Teks Arab berharakat indah menggunakan Google Font *Amiri*, transliterasi Latin, dan terjemahan resmi Kemenag RI.
- **Audio Murottal 6 Qari Internasional:**
  - Abdullah Al-Juhany
  - Abdul Muhsin Al-Qasim
  - Abdurrahman As-Sudais
  - Ibrahim Al-Dossari
  - Misyari Rasyid Al-Afasi
  - Yasser Al-Dosari
- **Kontrol Audio Penuh:** Putar surat penuh atau audio per ayat dengan sticky audio player bar di bawah layar.
- **Tafsir Tahlili Kemenag RI:** Tafsir mendalam ayat demi ayat.
- **Fitur Tambahan:** Salin ayat dan simpan penanda terakhir dibaca (*Last Read*) via LocalStorage.

### 2. Kumpulan Doa Harian & Dzikir
- **227+ Doa Shahih:** Bersumber dari hadits Rasulullah SAW (Hisnul Muslim).
- **Filter Kategori / Tag:** Tidur, Wudhu, Shalat, Rezeki, Perlindungan, Orang Tua, dan lainnya.
- **Pencarian Cepat:** Filter instan berdasarkan nama doa, terjemahan, dan teks Arab.
- **Salin Doa:** Tombol sekali klik untuk menyalin doa berharakat, latin, dan artinya ke clipboard.

### 3. Jadwal Shalat & Imsakiyah Indonesia (Pengayaan)
- **Cakupan Seluruh Indonesia:** 34 Provinsi dan 517+ Kabupaten/Kota.
- **Integrasi GET & POST:** Sesuai dokumentasi eQuran.id v2.
- **Realtime Countdown:** Hitung mundur waktu adzan shalat berikutnya secara otomatis berdasarkan jam lokal perangkat pengguna.
- **Jadwal Sebulan Penuh:** Tabel bulanan rapi dengan highlight hari ini dan fitur *Print-friendly*.

### 4. Lembar Kerja Peserta Didik (LKPD) & Laporan
- Halaman web khusus `/laporan` dan berkas `LAPORAN_LKPD.md` yang menjawab tuntas 3 pertanyaan evaluasi:
  1. Kesesuaian layanan dengan tujuan website
  2. Alur pemrosesan request dari controller hingga tampil
  3. Masalah yang ditemukan saat pengujian dan solusi perbaikannya

---

## 🚀 Cara Menjalankan Proyek

1. **Prasyarat:**
   - PHP >= 8.2 (diuji pada PHP 8.5)
   - Composer
   - Node.js & NPM

2. **Instalasi Dependensi:**
   ```bash
   composer install
   npm install
   ```

3. **Build Frontend:**
   ```bash
   npm run build
   ```

4. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Buka di peramban: `http://localhost:8000`

5. **Menjalankan Pengujian (Testing):**
   ```bash
   php artisan test
   ```

---

## 🏗️ Struktur Arsitektur

```
app/
├── Http/Controllers/
│   ├── HomeController.php      # Beranda & ringkasan widget
│   ├── QuranController.php     # Modul Al-Qur'an, ayat & tafsir
│   ├── DoaController.php       # Modul Doa Harian & filter tag
│   ├── SholatController.php    # Modul Jadwal Shalat (GET & POST)
│   └── LaporanController.php   # Lembar Kerja & Laporan LKPD
└── Services/
    └── EquranService.php       # HTTP Client wrapper + Cache layer

resources/
├── css/
│   └── app.css                 # Tailwind CSS v4 & custom Islamic styles
└── views/
    ├── layouts/app.blade.php   # Layout utama & sticky audio player
    ├── home.blade.php          # Beranda
    ├── quran/
    │   ├── index.blade.php     # Daftar surat & pencarian
    │   ├── show.blade.php      # Detail surat, audio & tafsir
    │   └── show_error.blade.php # Error fallback
    ├── doa/
    │   ├── index.blade.php     # Daftar doa & filter kategori
    │   ├── show.blade.php      # Detail doa & doa terkait
    │   └── not_found.blade.php # 404 fallback doa
    ├── sholat/
    │   └── index.blade.php     # Jadwal shalat bulanan & AJAX kota
    └── laporan.blade.php       # Laporan LKPD interaktif
```

---

&copy; {{ date('Y') }} Nurul Qur'an • Proyek Praktik Individu RPL.
