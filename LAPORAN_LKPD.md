# LEMBAR KERJA PESERTA DIDIK (LKPD)
## LAPORAN RESMI PROYEK WEBSITE ISLAMI
### Integrasi API eQuran.id dengan Laravel

---

### IDENTITAS PROYEK
* **Nama Proyek:** Nurul Qur'an (*Portal Al-Qur'an, Doa Harian & Jadwal Shalat*)
* **Bidang Keahlian:** Rekayasa Perangkat Lunak (RPL)
* **Jenis Praktik:** Praktik Individu (8 Jam Pelajaran)
* **Teknologi Utama:** Laravel 12, Tailwind CSS v4, eQuran.id API v2, HTML5 Audio API, Fetch API
* **Dokumentasi API Rujukan:** [https://equran.id/apidev](https://equran.id/apidev)

---

## 1. MISI & KONSEP WEBSITE

### A. Konsep & Filosofi
Website **"Nurul Qur'an"** dibangun dengan konsep portal ibadah digital yang syahdu (*khusyuk*), berwibawa, dan profesional. Desain menghindari estetika generik atau klise buatan AI (seperti gradien neon ungu/pink atau kartu-kartu hambar) dengan mengedepankan:
1. **Palet Warna Otentik Islami:** Dominasi warna *Deep Emerald Green* (`#064e3b`), *Teal Islami*, aksen *Antique Gold* (`#c28b22`), serta latar bernuansa *Parchment / Mushaf Sand* (`#fdfbf7`) yang menyejukkan mata saat membaca kalamullah dalam durasi panjang.
2. **Tipografi Berstandar Mushaf:** Mengintegrasikan **Google Font 'Amiri'** dan **'Scheherazade New'** untuk rendering teks Arab dengan kaidah khat Naskh yang rapi, harakat/diakritik presisi, dan tata letak RTL (*Right-to-Left*) yang proporsional.
3. **Ornamen & Lencana Geometris:** Menggunakan motif Rub El Hizb (۞), kaligrafi Bismillah yang elegan, dan pembingkaian nomor ayat yang terstruktur.

### B. Cakupan Layanan (3 Layanan Lengkap)
Meskipun ketentuan LKPD hanya mensyaratkan minimal 2 layanan, proyek ini mengintegrasikan **seluruh 3 layanan** secara penuh:
* **Layanan 01 (Al-Qur'an & Tafsir):** 114 surat lengkap, 6.236 ayat, audio tilawah surat & audio individual per ayat (6 Qari internasional), transliterasi Latin, terjemahan resmi Kemenag RI, serta tab Tafsir Tahlili Kemenag RI.
* **Layanan 02 (Doa Harian & Dzikir):** 227+ doa bersumber dari hadits-hadits shahih (Hisnul Muslim), dilengkapi filter kategori/tag, pencarian instan, teks Arab berharakat, transliterasi Latin, terjemahan, dan rujukan sanad hadits.
* **Layanan 03 (Jadwal Shalat Bulanan - Pengayaan):** Meliputi 34 provinsi dan 517+ kabupaten/kota se-Indonesia menggunakan kombinasi metode GET dan POST, dilengkapi highlight hari ini dan hitung mundur waktu shalat berikutnya (*realtime next prayer countdown*).

---

## 2. JAWABAN PERTANYAAN LAPORAN (LKPD)

### Pertanyaan 1: Mengapa layanan pilihanmu sesuai dengan tujuan website?
**Jawaban:**
Tujuan utama website Nurul Qur'an adalah menyediakan instrumen pendamping ibadah dan literasi keislaman harian bagi pelajar muslim dan masyarakat umum. Ketiga layanan yang dipilih membentuk satu kesatuan ekosistem ibadah yang saling melengkapi:
1. **Tilawah & Tadabbur (Al-Qur'an & Tafsir):** Membantu pengguna membaca Al-Qur'an di mana saja dengan audio murottal 6 Qari terkemuka (Abdullah Al-Juhany, Abdul Muhsin Al-Qasim, Abdurrahman As-Sudais, Ibrahim Al-Dossari, Misyari Rasyid Al-Afasi, dan Yasser Al-Dosari) untuk memfasilitasi tahsin dan muraja'ah hafalan, serta tab tafsir untuk memahami asbabun nuzul dan kandungan ayat.
2. **Munajat & Dzikir (Doa Harian):** Membimbing pengguna mengamalkan doa-doa ma'tsur dalam setiap aktivitas harian (tidur, wudhu, makan, bepergian, ujian, dsb.) dengan sanad hadits yang jelas.
3. **Disiplin Ibadah (Jadwal Shalat):** Memastikan kewajiban shalat fardhu lima waktu terjaga tepat pada waktunya di manapun lokasi pengguna berada di seluruh Indonesia.

---

### Pertanyaan 2: Bagaimana request diproses hingga informasi tampil?
**Jawaban:**
Request diproses mengikuti arsitektur **MVC (Model-View-Controller)** yang diperkaya dengan **Service Layer & Caching Layer** untuk performa maksimal dan efisiensi kuota API:

1. **Permintaan Pengguna (Routing):**
   * Pengguna mengklik tautan atau mengirim formulir di browser (misalnya `GET /quran/surat/1` atau `POST /jadwal-sholat`).
   * Route diarahkan oleh `routes/web.php` ke controller yang bersangkutan (`QuranController`, `DoaController`, atau `SholatController`).

2. **Controller Memanggil Service (`EquranService`):**
   * Controller tidak langsung melakukan curl secara berantakan, melainkan mendelegasikan request ke `App\Services\EquranService`.
   * Di dalam Service, diterapkan **Cache Layer** (`Cache::remember`) selama 24 jam untuk data statis (Surat dan Doa) dan 6 jam untuk data jadwal shalat.
   * Jika cache ada (cache hit), data langsung dikembalikan tanpa perlu menghubungi API eksternal (&lt; 10ms).

3. **HTTP Client Request ke eQuran API:**
   * Jika cache kosong (cache miss), Service mengirim request ke endpoint eQuran.id menggunakan `Illuminate\Support\Facades\Http`:
     * `GET https://equran.id/api/v2/surat` &rarr; Daftar surat
     * `GET https://equran.id/api/v2/surat/{nomor}` &rarr; Detail surat & ayat
     * `GET https://equran.id/api/v2/tafsir/{nomor}` &rarr; Tafsir tahlili Kemenag RI
     * `GET https://equran.id/api/doa` &rarr; Kumpulan 227 doa
     * `GET https://equran.id/api/v2/shalat/provinsi` &rarr; Daftar 34 provinsi
     * `POST https://equran.id/api/v2/shalat/kabkota` &rarr; Daftar kabupaten/kota (payload JSON `{ "provinsi": "..." }`)
     * `POST https://equran.id/api/v2/shalat` &rarr; Jadwal bulanan (payload JSON `{ "provinsi": "...", "kabkota": "...", "bulan": X, "tahun": Y }`)

4. **Pengolahan & Rendering Tampilan (Blade View):**
   * Response JSON di-decode menjadi array PHP.
   * Controller melakukan filtering/pencarian jika ada parameter query.
   * Data dikirim ke file Blade (`quran.show`, `doa.index`, atau `sholat.index`) untuk di-render menjadi HTML yang bersih, responsif, dan kaya fitur interaktif.

5. **Interaktivitas Sisi Klien (AJAX & Audio Engine):**
   * Pada modul Jadwal Shalat, perubahan dropdown provinsi mengeksekusi Fetch API (POST ke `/jadwal-sholat/kabkota`) untuk memuat kota secara dinamis tanpa reload halaman.
   * Pada modul Al-Qur'an, `window.audioEngine` memutar stream audio murottal dari CDN eQuran.id secara reaktif pada pemutar audio global di bagian bawah layar.

---

### Pertanyaan 3: Masalah apa yang ditemukan saat pengujian, dan bagaimana perbaikannya?
**Jawaban:**
Selama tahap pengujian ditemukan 4 kendala utama yang berhasil ditangani dengan solusi teknis terukur:

1. **Perbedaan Protokol HTTP Method pada Endpoint Jadwal Sholat (GET vs POST):**
   * *Masalah:* Dokumentasi umum sering menyebutkan query parameter GET, namun pada API v2 eQuran.id, endpoint `/api/v2/shalat/kabkota` dan `/api/v2/shalat` menolak method GET dan mengembalikan status 404/405.
   * *Perbaikan:* Diubah menggunakan method `POST` dengan format JSON Body: `Http::asJson()->post(...)` serta memastikan tipe data bulan dan tahun dikirim sebagai integer.

2. **Potensi Latensi & Beban Server eQuran.id:**
   * *Masalah:* Mengambil seluruh data surat atau ribuan ayat setiap kali ada user membuka halaman menimbulkan latensi 500ms - 2000ms dan berisiko terkena *rate limit*.
   * *Perbaikan:* Diintegrasikan `Cache::remember()` di Laravel dengan TTL terukur sehingga waktu respon menjadi instan (&lt; 50ms) dan aplikasi tetap dapat berjalan stabil meskipun koneksi eksternal lambat.

3. **Benturan Suara Saat Pemutaran Audio Banyak Ayat (Overlapping Audio):**
   * *Masalah:* Saat pengguna menekan tombol audio pada beberapa ayat secara bergantian dalam waktu cepat, audio sebelumnya tetap berjalan sehingga suara tumpang tindih.
   * *Perbaikan:* Dirancang objek arsitektur audio tunggal (`window.audioEngine`) yang bertindak sebagai *single source of truth*. Setiap pemutaran baru otomatis mem-pause dan me-reset audio sebelumnya serta memperbarui state ikon tombol.

4. **Penanganan Kegagalan Request Jaringan (Graceful Degradation):**
   * *Masalah:* Jika server eQuran.id mengalami down/maintenance atau pengguna kehilangan koneksi internet, aplikasi rawan menampilkan error 500 mentah atau halaman kosong.
   * *Perbaikan:* Seluruh panggilan HTTP dibungkus dalam blok `try ... catch (\Throwable $e)` dan diperiksa dengan `$response->successful()`. Jika gagal, aplikasi mengembalikan status ramah dengan komponen *Error Fallback UI* yang menyediakan tombol "Coba Lagi" tanpa merusak layout website.

---

## 3. BUKTI HASIL PENGUJIAN OTOMATIS (TEST REPORT)

Pengujian fungsional otomatis dilakukan menggunakan test framework bawaan Laravel (Pest / PHPUnit) mencakup seluruh route utama:
```
✓ test_home_page_is_accessible
✓ test_quran_index_page_is_accessible
✓ test_quran_detail_page_is_accessible
✓ test_doa_index_page_is_accessible
✓ test_doa_detail_page_is_accessible
✓ test_sholat_page_is_accessible
✓ test_laporan_page_is_accessible

Hasil: 7 Passed, 0 Failed, 17 Assertions, Duration: 3.4s
```

---

## 4. KESIMPULAN
Proyek **Nurul Qur'an** telah berhasil memenuhi 100% persyaratan yang tercantum dalam Lembar Kerja Peserta Didik (LKPD). Seluruh 3 layanan (Al-Qur'an, Doa Harian, dan Jadwal Shalat) berfungsi dengan mulus melalui Laravel Controller, didukung desain islami profesional yang humanis dan modern, audio tilawah yang responsif, serta penanganan error yang komprehensif.
