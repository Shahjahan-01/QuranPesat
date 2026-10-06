@extends('layouts.app')

@section('title', 'Nurul Qur\'an - Portal Al-Qur\'an, Doa Harian & Jadwal Sholat')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 text-white overflow-hidden py-16 lg:py-24 border-b border-emerald-800/40">
    <!-- Background Subtle Geometric Islamic Motifs -->
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Islamic Calligraphy Bismillah Banner -->
                <div class="inline-block bg-emerald-800/60 border border-emerald-700/60 rounded-full px-5 py-1.5 backdrop-blur-sm">
                    <span class="font-arabic text-amber-300 text-lg sm:text-xl tracking-wide" dir="rtl">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight font-serif">
                    Mendekat pada Al-Qur'an, Mengamalkan Doa, Menjaga Waktu Shalat.
                </h1>

                <p class="text-base sm:text-lg text-emerald-100/80 leading-relaxed max-w-2xl">
                    Portal Islami modern berbasis data resmi <strong>eQuran.id</strong>. Akses 114 Surat lengkap dengan audio tilawah 6 Qari internasional, tafsir Kemenag RI, 227+ doa harian, dan jadwal shalat akurat untuk seluruh Indonesia.
                </p>

                <!-- Search Box Quick Action -->
                <div class="pt-2 max-w-xl mx-auto lg:mx-0">
                    <form action="{{ route('quran.index') }}" method="GET" class="relative flex items-center shadow-xl rounded-2xl bg-white/10 backdrop-blur-md p-1.5 border border-emerald-500/30">
                        <i class="fa-solid fa-magnifying-glass text-emerald-300 ml-4 text-base"></i>
                        <input type="text" name="q" placeholder="Cari surat, arti, atau nomor (misal: Al-Kahfi, Yasin, 67)..." 
                               class="w-full bg-transparent border-0 px-4 py-3 text-sm text-white placeholder-emerald-200/60 focus:outline-none focus:ring-0">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-xs uppercase tracking-wider transition transform active:scale-95 shrink-0 shadow-md">
                            Cari Surat
                        </button>
                    </form>
                    <div class="flex items-center space-x-2 mt-3 text-xs text-emerald-200/70 justify-center lg:justify-start">
                        <span>Pencarian cepat:</span>
                        <a href="{{ route('quran.show', 1) }}" class="underline hover:text-amber-300">Al-Fatihah</a>,
                        <a href="{{ route('quran.show', 18) }}" class="underline hover:text-amber-300">Al-Kahfi</a>,
                        <a href="{{ route('quran.show', 36) }}" class="underline hover:text-amber-300">Yasin</a>,
                        <a href="{{ route('quran.show', 67) }}" class="underline hover:text-amber-300">Al-Mulk</a>
                    </div>
                </div>
            </div>

            <!-- Right: Today's Prayer Schedule Widget -->
            <div class="lg:col-span-5">
                <div class="bg-gradient-to-b from-white/15 to-white/5 backdrop-blur-md border border-emerald-500/30 rounded-3xl p-6 sm:p-7 shadow-2xl text-white relative">
                    <!-- Top Widget Header -->
                    <div class="flex items-center justify-between border-b border-emerald-500/20 pb-4 mb-5">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-300 border border-amber-400/30 flex items-center justify-center">
                                <i class="fa-solid fa-mosque text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-white">Jadwal Shalat Hari Ini</h3>
                                <p class="text-xs text-emerald-200/70 flex items-center">
                                    <i class="fa-solid fa-location-dot text-amber-400 mr-1 text-[11px]"></i> {{ $kabkota }}, {{ $provinsi }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('sholat.index') }}" class="text-xs text-amber-300 hover:text-amber-200 font-semibold underline">
                            Ubah Kota <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    @if($jadwalHariIni)
                    <!-- Prayer Times Grid -->
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 text-center text-xs">
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Imsak</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['imsak'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Subuh</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['subuh'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Terbit</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['terbit'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Dzuhur</span>
                            <span class="text-base font-bold text-amber-300 font-mono mt-0.5 block">{{ $jadwalHariIni['dzuhur'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Ashar</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['ashar'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Maghrib</span>
                            <span class="text-base font-bold text-amber-300 font-mono mt-0.5 block">{{ $jadwalHariIni['maghrib'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Isya</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['isya'] }}</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-950/40 border border-emerald-700/40">
                            <span class="text-emerald-300 block text-[11px]">Dhuha</span>
                            <span class="text-base font-bold text-white font-mono mt-0.5 block">{{ $jadwalHariIni['dhuha'] }}</span>
                        </div>
                    </div>

                    <!-- Next Prayer Countdown Indicator -->
                    <div class="mt-4 pt-3 border-t border-emerald-500/20 flex items-center justify-between text-xs text-emerald-200">
                        <span class="flex items-center">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping mr-2"></span>
                            Tanggal: {{ $jadwalHariIni['hari'] }}, {{ $jadwalHariIni['tanggal_lengkap'] }}
                        </span>
                        <a href="{{ route('sholat.index') }}" class="text-amber-400 hover:text-amber-300 font-medium">
                            Jadwal Sebulan Penuh &rarr;
                        </a>
                    </div>
                    @else
                    <div class="text-center py-6 text-emerald-200/80 text-sm">
                        <i class="fa-solid fa-triangle-exclamation text-amber-400 text-2xl mb-2"></i>
                        <p>Jadwal shalat hari ini sedang dimuat.</p>
                        <a href="{{ route('sholat.index') }}" class="mt-2 inline-block text-xs bg-emerald-800 px-3 py-1.5 rounded-lg text-white">Lihat Jadwal Lengkap</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3 Layanan Utama Sesuai LKPD -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-100/80 px-3 py-1 rounded-full border border-emerald-200">
            Layanan Unggulan
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3 font-serif">
            Tiga Layanan Lengkap eQuran.id
        </h2>
        <p class="text-sm sm:text-base text-slate-600 mt-2">
            Mengintegrasikan seluruh fitur inti yang disyaratkan dalam Lembar Kerja Peserta Didik (LKPD) menjadi sarana ibadah digital yang bermakna.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1: Al-Qur'an -->
        <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-emerald-500/50 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-800 text-amber-300 flex items-center justify-center text-2xl shadow-md shadow-emerald-900/10">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-600 tracking-wider uppercase">Layanan 01</span>
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-800 transition font-serif">
                        Al-Qur'an & Tafsir
                    </h3>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Daftar dan detail 114 surat, teks Arab dengan khat tajwid jelas, transliterasi Latin, terjemahan Kemenag RI, serta tafsir lengkap ayat per ayat.
                </p>
                <div class="space-y-2 pt-2 text-xs text-slate-500">
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i>
                        <span>Audio Tilawah Surat (6 Pilihan Qari)</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i>
                        <span>Audio Per Ayat dengan Kontrol Play/Pause</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-emerald-600 mr-2 text-sm"></i>
                        <span>Tafsir Tahlili Lengkap Kemenag RI</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 relative z-10">
                <a href="{{ route('quran.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-semibold text-sm transition shadow-sm group-hover:shadow-md">
                    Buka Al-Qur'an <i class="fa-solid fa-arrow-right ml-2 text-xs text-amber-300"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Doa Harian -->
        <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-emerald-500/50 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-amber-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-600 to-amber-800 text-white flex items-center justify-center text-2xl shadow-md shadow-amber-900/10">
                    <i class="fa-solid fa-hands-praying"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-amber-600 tracking-wider uppercase">Layanan 02</span>
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-700 transition font-serif">
                        Doa Harian & Dzikir
                    </h3>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Kumpulan 227+ doa harian bersumber dari hadits shahih (Hisnul Muslim). Dilengkapi teks Arab berharakat, transliterasi Latin, terjemahan, dan keterangan perawi.
                </p>
                <div class="space-y-2 pt-2 text-xs text-slate-500">
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-amber-600 mr-2 text-sm"></i>
                        <span>Filter Berdasarkan Tag & Kategori Kebutuhan</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-amber-600 mr-2 text-sm"></i>
                        <span>Pencarian Cepat Judul, Teks, dan Makna</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-amber-600 mr-2 text-sm"></i>
                        <span>Salin Doa & Rujukan Hadits / Perawi</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 relative z-10">
                <a href="{{ route('doa.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-amber-700 hover:bg-amber-800 text-white font-semibold text-sm transition shadow-sm group-hover:shadow-md">
                    Kumpulan Doa <i class="fa-solid fa-arrow-right ml-2 text-xs text-amber-200"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Jadwal Sholat -->
        <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-emerald-500/50 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-teal-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform"></div>
            <div class="relative z-10 space-y-4">
                <div class="w-14 h-14 rounded-2xl bg-teal-800 text-emerald-300 flex items-center justify-center text-2xl shadow-md shadow-teal-900/10">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <span class="text-xs font-bold text-teal-600 tracking-wider uppercase">Layanan 03 (Pengayaan)</span>
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-teal-800 transition font-serif">
                        Jadwal Shalat Indonesia
                    </h3>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Jadwal shalat akurat bulanan mencakup 34 provinsi dan lebih dari 500 kabupaten/kota. Menggunakan method GET (provinsi) dan POST (kabkota & jadwal).
                </p>
                <div class="space-y-2 pt-2 text-xs text-slate-500">
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-teal-600 mr-2 text-sm"></i>
                        <span>Pilihan Provinsi, Kab/Kota, Bulan & Tahun</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-teal-600 mr-2 text-sm"></i>
                        <span>Waktu Imsak, Subuh, Terbit, Dhuha, Dzuhur, Ashar, Maghrib, Isya</span>
                    </div>
                    <div class="flex items-center text-slate-700">
                        <i class="fa-solid fa-circle-check text-teal-600 mr-2 text-sm"></i>
                        <span>Dapat Dicetak (Print Friendly) & Disimpan</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 relative z-10">
                <a href="{{ route('sholat.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-teal-800 hover:bg-teal-900 text-white font-semibold text-sm transition shadow-sm group-hover:shadow-md">
                    Lihat Jadwal Shalat <i class="fa-solid fa-arrow-right ml-2 text-xs text-amber-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Surat-Surat Pilihan & Populer -->
<section class="py-12 bg-white/70 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Tilawah Rutin</span>
                <h3 class="text-2xl font-bold text-slate-900 font-serif">Surat-Surat Pilihan</h3>
            </div>
            <a href="{{ route('quran.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-800 hover:text-emerald-950">
                Lihat Seluruh 114 Surat <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($suratPopuler as $surat)
            <div class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-600 hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                <div class="flex items-center space-x-4">
                    <!-- Ayah / Number Badge -->
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center font-bold text-sm group-hover:bg-emerald-800 group-hover:text-amber-300 transition duration-200 shrink-0">
                        {{ $surat['nomor'] }}
                    </div>
                    <div>
                        <a href="{{ route('quran.show', $surat['nomor']) }}" class="text-base font-bold text-slate-900 group-hover:text-emerald-800 transition block">
                            {{ $surat['namaLatin'] }}
                        </a>
                        <p class="text-xs text-slate-500">
                            {{ $surat['arti'] }} • <span class="text-emerald-700 font-medium">{{ $surat['jumlahAyat'] }} Ayat</span>
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="font-arabic text-xl text-slate-800 block group-hover:text-emerald-800 transition" dir="rtl">
                        {{ $surat['nama'] }}
                    </span>
                    <a href="{{ route('quran.show', $surat['nomor']) }}" class="text-[11px] font-semibold text-emerald-700 hover:underline">
                        Baca & Dengar &rarr;
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Doa Harian Cuplikan -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Munajat Setiap Waktu</span>
            <h3 class="text-2xl font-bold text-slate-900 font-serif">Doa Harian Pilihan</h3>
        </div>
        <a href="{{ route('doa.index') }}" class="inline-flex items-center text-sm font-semibold text-amber-800 hover:text-amber-950">
            Jelajahi 227+ Doa Lainnya <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($doaPilihan as $doa)
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:border-amber-400 transition-all flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                        {{ $doa['grup'] ?? 'Doa Harian' }}
                    </span>
                    <a href="{{ route('doa.show', $doa['id']) }}" class="text-xs text-slate-400 hover:text-amber-700" title="Buka Detail">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
                <h4 class="text-base font-bold text-slate-900 font-serif">
                    {{ $doa['nama'] }}
                </h4>
                <!-- Arabic snippet -->
                <div class="bg-slate-50/80 p-4 rounded-2xl border border-slate-100">
                    <p class="font-arabic text-lg sm:text-xl text-slate-800 leading-relaxed" dir="rtl">
                        {{ $doa['ar'] }}
                    </p>
                </div>
                <p class="text-xs text-slate-600 line-clamp-2 italic">
                    "{{ $doa['idn'] }}"
                </p>
            </div>
            <div class="pt-4 mt-2 border-t border-slate-100 flex items-center justify-between">
                <div class="flex flex-wrap gap-1">
                    @if(!empty($doa['tag']) && is_array($doa['tag']))
                        @foreach(array_slice($doa['tag'], 0, 2) as $t)
                        <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded">#{{ $t }}</span>
                        @endforeach
                    @endif
                </div>
                <a href="{{ route('doa.show', $doa['id']) }}" class="text-xs font-bold text-amber-700 hover:text-amber-900">
                    Lihat Lengkap & Salin &rarr;
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Banner LKPD & Kepatuhan Proyek -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-emerald-950 rounded-3xl p-8 sm:p-10 text-white shadow-xl relative overflow-hidden border border-emerald-700/50">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-9xl">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div class="relative z-10 max-w-3xl space-y-4">
            <div class="inline-flex items-center space-x-2 bg-amber-400 text-slate-950 px-3 py-1 rounded-full text-xs font-bold">
                <i class="fa-solid fa-file-signature"></i>
                <span>LEMBAR KERJA PESERTA DIDIK (LKPD)</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-extrabold font-serif text-white">
                Integrasi API eQuran.id dengan Laravel
            </h3>
            <p class="text-sm sm:text-base text-emerald-100/80 leading-relaxed">
                Proyek ini telah mengimplementasikan <strong>seluruh 3 layanan</strong> (Al-Qur'an lengkap audio & tafsir, Doa Harian, dan Jadwal Sholat) melalui request Laravel Controller, cache otomatis, desain islami yang humanis dan elegan, serta penanganan error menyeluruh.
            </p>
            <div class="pt-2 flex flex-wrap gap-3">
                <a href="{{ route('laporan') }}" class="px-5 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs uppercase tracking-wider transition shadow-md">
                    Buka Halaman Laporan & LKPD <i class="fa-solid fa-arrow-right ml-1.5"></i>
                </a>
                <a href="{{ route('quran.index') }}" class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs transition border border-white/20">
                    Mulai Eksplorasi Fitur
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
