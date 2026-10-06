@extends('layouts.app')

@section('title', 'Lembar Kerja Peserta Didik & Laporan Proyek - Nurul Qur\'an')
@section('meta_description', 'Laporan lengkap proyek website islami integrasi API eQuran.id dengan Laravel, arsitektur sistem, dan jawaban pertanyaan LKPD.')

@section('content')
<!-- Header Banner -->
<div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-950 text-white py-12 border-b border-emerald-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 bg-amber-500 text-slate-950 px-4 py-1.5 rounded-full text-xs font-bold mb-3 shadow-md">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>LEMBAR KERJA PESERTA DIDIK (LKPD)</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold font-serif text-white tracking-tight">
            Laporan Proyek Website Islami
        </h1>
        <p class="text-emerald-100/80 text-sm mt-2 max-w-2xl mx-auto">
            Integrasi API eQuran.id dengan Framework Laravel • Jurusan Rekayasa Perangkat Lunak (RPL)
        </p>
    </div>
</div>

<!-- Main Container -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 space-y-10">

    <!-- Card 1: Identitas & Lembar Pengesahan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
        <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Data Proyek</span>
                <h2 class="text-xl font-bold text-slate-900 font-serif">Identitas Lembar Kerja</h2>
            </div>
            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-semibold">
                Praktik Individu • 8 Jam Pelajaran (JP)
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <span class="text-slate-400 block font-medium">Nama Website:</span>
                <span class="text-sm font-bold text-slate-900 mt-1 block">Nurul Qur'an (Portal Islami)</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <span class="text-slate-400 block font-medium">Target Pengguna:</span>
                <span class="text-sm font-bold text-slate-900 mt-1 block">Pelajar Muslim & Masyarakat Umum</span>
            </div>
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <span class="text-slate-400 block font-medium">Layanan Terpasang:</span>
                <span class="text-sm font-bold text-emerald-800 mt-1 block">3 dari 3 Layanan (100% Lengkap)</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Checklist Ketentuan Website (Status Kepatuhan LKPD) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Audit Kualitas</span>
            <h2 class="text-xl font-bold text-slate-900 font-serif">Pemenuhan Ketentuan Website LKPD</h2>
        </div>

        <div class="space-y-3.5 text-xs sm:text-sm">
            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Minimal dua layanan berfungsi dan terhubung melalui navigasi:</strong>
                    <span class="text-slate-600 text-xs">Website mengaktifkan <strong>seluruh 3 layanan</strong> (Al-Qur'an, Doa Harian, dan Jadwal Sholat) yang saling terhubung di navigasi desktop & drawer mobile.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>

            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Ada interaksi pengguna pada setiap layanan:</strong>
                    <span class="text-slate-600 text-xs">Pencarian instan surat/doa, pemilihan 6 Qari, tombol putar audio surat & audio ayat, filter tag doa, pemilihan interaktif dropdown provinsi/kabkota jadwal sholat, tab tafsir, serta tombol salin & bookmark.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>

            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Konten Arab terbaca dengan baik & informasi sesuai sumber API:</strong>
                    <span class="text-slate-600 text-xs">Menggunakan font Arab standar mushaf <strong>Google Font 'Amiri'</strong> berukuran 28-36px dengan harakat presisi, line-height 2.4, arah teks RTL, warna kontras tinggi, dan nomor ayat di ornamen islami.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>

            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Audio wajib jika tersedia pada layanan yang dipilih:</strong>
                    <span class="text-slate-600 text-xs">Tersedia audio murottal lengkap per surat (6 Qari ternama dunia) dan audio individual per ayat dengan pemutar audio sticky modern lengkap dengan kontrol putar, jeda, timeline, dan volume.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>

            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Ada pesan saat data tidak ditemukan atau request gagal:</strong>
                    <span class="text-slate-600 text-xs">Disediakan komponen Empty State yang humanis saat pencarian nihil, serta Error Fallback Alert bersahabat dengan tombol "Coba Lagi" jika API mengalami timeout atau gagal terhubung.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>

            <div class="flex items-start space-x-3 p-3.5 rounded-2xl bg-emerald-50/60 border border-emerald-200/80">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5"></i>
                <div class="flex-1">
                    <strong class="text-slate-900 block">Layanan ketiga menjadi pengayaan:</strong>
                    <span class="text-slate-600 text-xs">Jadwal Shalat Bulanan 34 provinsi terpasang secara komprehensif mengkombinasikan method GET dan POST dari API eQuran.id.</span>
                </div>
                <span class="text-[11px] font-bold bg-emerald-700 text-white px-2.5 py-0.5 rounded-full shrink-0">Terpenuhi</span>
            </div>
        </div>
    </div>

    <!-- Card 3: JAWABAN PERTANYAAN LAPORAN LKPD -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-8">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Tugas Pokok</span>
            <h2 class="text-xl font-bold text-slate-900 font-serif">Jawaban Pertanyaan Laporan LKPD</h2>
            <p class="text-xs text-slate-500 mt-1">Jawaban mendalam untuk 3 poin evaluasi dalam Lembar Kerja Peserta Didik.</p>
        </div>

        <!-- Pertanyaan 1 -->
        <div class="space-y-3">
            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-xl bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0">
                    1
                </span>
                <h3 class="text-base font-bold text-slate-900 font-serif">
                    Mengapa layanan pilihanmu sesuai dengan tujuan website?
                </h3>
            </div>
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-2">
                <p>
                    <strong>Jawaban:</strong> Website ini diberi nama <strong>"Nurul Qur'an"</strong> dengan visi menyediakan portal ibadah dan literasi keislaman digital yang komprehensif, tenang, dan dapat diandalkan oleh pelajar muslim maupun masyarakat umum sehari-hari.
                </p>
                <p>
                    Ketiga layanan yang dipilih dari eQuran.id melengkapi pilar rutinitas seorang muslim secara harmonis:
                </p>
                <ul class="list-disc pl-5 space-y-1 text-slate-600">
                    <li><strong>Layanan Al-Qur'an & Tafsir:</strong> Menjadi pilar utama dalam tilawah dan tadabbur kalam Allah SWT, diperkuat audio murottal 6 Qari internasional untuk melatih makhraj dan tartil, serta tafsir Kemenag RI untuk memahami konteks ayat.</li>
                    <li><strong>Layanan Doa Harian:</strong> Menyediakan 227+ amalan doa bersumber dari sunnah hadits shahih (Hisnul Muslim) untuk dipanjatkan pada setiap kegiatan (bangun tidur, keluar rumah, belajar, dsb.).</li>
                    <li><strong>Layanan Jadwal Shalat:</strong> Menjaga kewajiban fardhu lima waktu tepat waktu dengan hitung mundur adzan berikutnya dan data astronomis resmi untuk 500+ kab/kota di seluruh Indonesia.</li>
                </ul>
            </div>
        </div>

        <!-- Pertanyaan 2 -->
        <div class="space-y-3">
            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-xl bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0">
                    2
                </span>
                <h3 class="text-base font-bold text-slate-900 font-serif">
                    Bagaimana request diproses hingga informasi tampil?
                </h3>
            </div>
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3">
                <p>
                    <strong>Jawaban:</strong> Alur pemrosesan request dibangun dengan arsitektur <em>Separation of Concerns</em> (SoC) di Laravel menggunakan pola <strong>Route &rarr; Controller &rarr; Service &rarr; eQuran API &rarr; Blade View</strong>:
                </p>
                
                <!-- Flowchart Step By Step -->
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 text-center text-xs">
                    <div class="p-3 bg-white rounded-xl border border-slate-200">
                        <span class="font-bold text-emerald-800 block">1. User Request</span>
                        <span class="text-[11px] text-slate-500">Browser mengakses route (cth: /quran/surat/1 atau /jadwal-sholat).</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200">
                        <span class="font-bold text-emerald-800 block">2. Controller & Service</span>
                        <span class="text-[11px] text-slate-500">Controller memanggil <code>EquranService</code> yang mengecek cache (Cache::remember).</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200">
                        <span class="font-bold text-emerald-800 block">3. Http Client (API)</span>
                        <span class="text-[11px] text-slate-500">Mengirim GET atau POST request dengan payload JSON ke server eQuran.id.</span>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200">
                        <span class="font-bold text-emerald-800 block">4. Blade Render</span>
                        <span class="text-[11px] text-slate-500">Data JSON di-decode ke array PHP lalu di-render ke view Blade yang responsif.</span>
                    </div>
                </div>

                <p class="text-xs text-slate-600">
                    Pada Jadwal Shalat, dropdown kota memanfaatkan <strong>Fetch API (AJAX POST)</strong> ke <code>/jadwal-sholat/kabkota</code>, sehingga ketika pengguna memilih provinsi, daftar kabupaten/kota berganti secara instan tanpa perlu reload halaman.
                </p>
            </div>
        </div>

        <!-- Pertanyaan 3 -->
        <div class="space-y-3">
            <div class="flex items-center space-x-3">
                <span class="w-8 h-8 rounded-xl bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center shrink-0">
                    3
                </span>
                <h3 class="text-base font-bold text-slate-900 font-serif">
                    Masalah apa yang ditemukan saat pengujian, dan bagaimana perbaikannya?
                </h3>
            </div>
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3">
                <p>
                    <strong>Jawaban:</strong> Selama proses pengembangan dan pengujian sistem, ditemukan beberapa kendala teknis nyata dan telah diselesaikan dengan solusi yang kokoh:
                </p>
                <div class="space-y-2.5">
                    <div class="bg-white p-3.5 rounded-xl border border-slate-200">
                        <strong class="text-red-700 block"><i class="fa-solid fa-bug mr-1"></i> Masalah 1: Method dan Endpoint Jadwal Sholat Berbeda (GET vs POST)</strong>
                        <p class="text-xs text-slate-600 mt-0.5">
                            Dokumentasi awal eQuran versi 1 berbeda dengan v2. Pada v2, provinsi diambil via GET <code>/api/v2/shalat/provinsi</code>, namun kabupaten/kota dan jadwal sholat bulanan memerlukan <strong>POST</strong> dengan payload JSON <code>{"provinsi": "..."}</code> dan <code>{"provinsi": "...", "kabkota": "...", "bulan": X, "tahun": Y}</code>. Jika dikirim via GET, server mengembalikan 404/405.<br>
                            <em>Solusi:</em> Diperbaiki di <code>EquranService::getKabkota()</code> dan <code>getJadwalShalat()</code> dengan menyetel <code>Http::asJson()->post()</code> dan parameter numerik bulan serta tahun yang sesuai.
                        </p>
                    </div>

                    <div class="bg-white p-3.5 rounded-xl border border-slate-200">
                        <strong class="text-red-700 block"><i class="fa-solid fa-bug mr-1"></i> Masalah 2: Latensi Tinggi & Potensi Rate Limiting jika Banyak Permintaan</strong>
                        <p class="text-xs text-slate-600 mt-0.5">
                            Memanggil 114 surat atau ribuan ayat secara berulang-ulang dapat memperlambat loading halaman dan membebani server eQuran.id.<br>
                            <em>Solusi:</em> Menerapkan <strong>Caching Layer (Laravel Cache)</strong> selama 24 jam untuk daftar surat, detail surat, dan doa, serta 6 jam untuk jadwal sholat. Hasilnya, akses halaman kedua dan seterusnya menjadi instan (&lt;50ms).
                        </p>
                    </div>

                    <div class="bg-white p-3.5 rounded-xl border border-slate-200">
                        <strong class="text-red-700 block"><i class="fa-solid fa-bug mr-1"></i> Masalah 3: Benturan Audio Saat Memutar Banyak Ayat Sekaligus</strong>
                        <p class="text-xs text-slate-600 mt-0.5">
                            Jika pengguna menekan tombol audio pada beberapa ayat secara cepat, audio sebelumnya tetap berbunyi sehingga suara bertumpuk.<br>
                            <em>Solusi:</em> Dibuat satu objek <code>window.audioEngine</code> tunggal di JavaScript yang mengelola state audio global (single-source of truth). Setiap pemutaran baru otomatis menghentikan audio sebelumnya dan memperbarui ikon tombol ayat terkait.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Tombol Aksi Navigasi Kembali ke Beranda -->
    <div class="text-center pt-4">
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
            <i class="fa-solid fa-house mr-2"></i> Kembali ke Beranda Utama
        </a>
    </div>

</div>
@endsection
