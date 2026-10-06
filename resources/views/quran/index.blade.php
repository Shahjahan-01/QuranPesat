@extends('layouts.app')

@section('title', 'Daftar Surat Al-Qur\'an 30 Juz - Nurul Qur\'an')
@section('meta_description', 'Daftar lengkap 114 surat Al-Qur\'an beserta teks Arab, arti, jumlah ayat, tempat turun, dan audio murottal.')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-950 text-white py-12 border-b border-emerald-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center space-x-2 bg-emerald-800/80 text-amber-300 px-3 py-1 rounded-full text-xs font-semibold border border-emerald-700/60 mb-3">
                <i class="fa-solid fa-book-quran"></i>
                <span>Layanan 01 eQuran.id API</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold font-serif text-white tracking-tight">
                Al-Qur'an Al-Karim
            </h1>
            <p class="text-emerald-100/80 text-sm mt-1 max-w-xl">
                114 Surat lengkap dengan teks Arab berharakat, terjemahan resmi Kemenag RI, audio tilawah 6 Qari, dan tafsir per ayat.
            </p>
        </div>

        <div class="flex items-center justify-center sm:justify-end space-x-3 text-xs">
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">114</span>
                <span class="text-emerald-200">Surat</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">30</span>
                <span class="text-emerald-200">Juz</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">6.236</span>
                <span class="text-emerald-200">Ayat</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Search & Filter Controls -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-xs mb-8">
        <form action="{{ route('quran.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <!-- Search Input -->
            <div class="md:col-span-6 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" 
                       id="searchInput"
                       name="q" 
                       value="{{ $search }}"
                       placeholder="Cari nama surat, arti, atau nomor (cth: Al-Baqarah, Sapi Betina, 2)..."
                       class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:border-transparent transition">
            </div>

            <!-- Tempat Turun Filter -->
            <div class="md:col-span-4 flex items-center space-x-2">
                <a href="{{ route('quran.index', ['q' => $search]) }}" 
                   class="flex-1 text-center py-2.5 px-3 rounded-xl text-xs font-semibold border transition {{ empty($tempatTurun) ? 'bg-emerald-800 text-white border-emerald-800 shadow-xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                    Semua
                </a>
                <a href="{{ route('quran.index', ['q' => $search, 'tempat' => 'Mekah']) }}" 
                   class="flex-1 text-center py-2.5 px-3 rounded-xl text-xs font-semibold border transition {{ strtolower($tempatTurun) === 'mekah' ? 'bg-emerald-800 text-white border-emerald-800 shadow-xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                    Makkiyah
                </a>
                <a href="{{ route('quran.index', ['q' => $search, 'tempat' => 'Madinah']) }}" 
                   class="flex-1 text-center py-2.5 px-3 rounded-xl text-xs font-semibold border transition {{ strtolower($tempatTurun) === 'madinah' ? 'bg-emerald-800 text-white border-emerald-800 shadow-xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                    Madaniyah
                </a>
            </div>

            <!-- Submit & Reset -->
            <div class="md:col-span-2 flex items-center space-x-2">
                <button type="submit" class="flex-1 py-3 px-4 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold uppercase tracking-wider transition">
                    Filter
                </button>
                @if(!empty($search) || !empty($tempatTurun))
                <a href="{{ route('quran.index') }}" class="p-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs transition" title="Reset Filter">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                @endif
            </div>
        </form>

        <!-- Last Read Banner (from LocalStorage) -->
        <div id="lastReadBanner" class="hidden mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600 bg-amber-50/70 p-3 rounded-xl border border-amber-200/60">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-bookmark text-amber-600"></i>
                <span>Terakhir Dibaca: <strong id="lastReadSuratName" class="text-amber-900 font-bold">-</strong> (Ayat <span id="lastReadAyahNum">1</span>)</span>
            </div>
            <a id="lastReadLink" href="#" class="font-bold text-amber-800 hover:underline">
                Lanjutkan Membaca &rarr;
            </a>
        </div>
    </div>

    <!-- Error State Alert -->
    @if(!$isSuccess)
    <div class="bg-red-50 border border-red-200 rounded-3xl p-6 mb-8 text-center text-red-700">
        <i class="fa-solid fa-triangle-exclamation text-3xl text-red-500 mb-2"></i>
        <h3 class="font-bold text-base">Gagal Menghubungi API eQuran.id</h3>
        <p class="text-xs text-red-600 mt-1">{{ $errorMessage ?? 'Koneksi ke server pusat sedang mengalami gangguan.' }}</p>
        <a href="{{ route('quran.index') }}" class="mt-4 inline-block px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition">
            <i class="fa-solid fa-arrows-rotate mr-1"></i> Coba Muat Ulang
        </a>
    </div>
    @endif

    <!-- Surat Grid -->
    @if(count($suratList) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5" id="suratGrid">
        @foreach($suratList as $surat)
        <div class="surat-card bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-600 hover:shadow-lg transition-all duration-200 flex flex-col justify-between group relative overflow-hidden"
             data-name="{{ strtolower($surat['namaLatin']) }}"
             data-arti="{{ strtolower($surat['arti']) }}"
             data-nomor="{{ $surat['nomor'] }}">
            
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center space-x-3.5">
                    <!-- Geometric 8-pointed star / Badge for Surah Number -->
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center font-bold text-sm group-hover:bg-emerald-800 group-hover:text-amber-300 transition duration-200 shrink-0 font-mono shadow-xs">
                        {{ $surat['nomor'] }}
                    </div>

                    <div>
                        <a href="{{ route('quran.show', $surat['nomor']) }}" class="text-base font-bold text-slate-900 group-hover:text-emerald-800 transition block font-serif">
                            {{ $surat['namaLatin'] }}
                        </a>
                        <p class="text-xs text-slate-500 line-clamp-1">
                            {{ $surat['arti'] }}
                        </p>
                    </div>
                </div>

                <!-- Arabic Surah Name -->
                <div class="text-right">
                    <span class="font-arabic text-2xl text-slate-800 group-hover:text-emerald-800 transition block" dir="rtl">
                        {{ $surat['nama'] }}
                    </span>
                </div>
            </div>

            <!-- Footer Details & Actions -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">
                        {{ $surat['tempatTurun'] }}
                    </span>
                    <span>•</span>
                    <span class="text-slate-600 font-medium">
                        {{ $surat['jumlahAyat'] }} Ayat
                    </span>
                </div>

                <div class="flex items-center space-x-2">
                    <!-- Quick Play Audio Button (First Qari) -->
                    @if(!empty($surat['audioFull']['05']) || !empty($surat['audioFull']['01']))
                    @php
                        $audioSrc = $surat['audioFull']['05'] ?? $surat['audioFull']['01'];
                    @endphp
                    <button type="button" 
                            onclick="window.audioEngine.playAudio('{{ $audioSrc }}', 'Surat {{ $surat['namaLatin'] }}', 'Qari: Misyari Rasyid Al-Afasi', this)"
                            class="p-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-800 hover:text-amber-300 transition" 
                            title="Putar Audio Murottal Surat">
                        <i class="fa-solid fa-play text-xs"></i>
                    </button>
                    @endif

                    <a href="{{ route('quran.show', $surat['nomor']) }}" 
                       class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-800 font-semibold group-hover:bg-emerald-800 group-hover:text-white transition text-xs">
                        Baca <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-lg mx-auto">
        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Surat Tidak Ditemukan</h3>
        <p class="text-xs text-slate-500 mt-1">
            Tidak ada surat yang cocok dengan kata kunci "{{ $search }}". Silakan periksa kembali ejaan atau gunakan nomor surat (1 - 114).
        </p>
        <a href="{{ route('quran.index') }}" class="mt-5 inline-block px-5 py-2.5 rounded-xl bg-emerald-800 text-white text-xs font-bold hover:bg-emerald-900 transition">
            Tampilkan Semua Surat
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Realtime client-side filter for instant responsiveness
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.surat-card');

    if (searchInput && cards.length > 0) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const arti = card.getAttribute('data-arti');
                const nomor = card.getAttribute('data-nomor');

                if (name.includes(val) || arti.includes(val) || nomor.includes(val)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Check last read from localStorage
    try {
        const lastRead = JSON.parse(localStorage.getItem('nurul_last_read'));
        if (lastRead && lastRead.suratNomor) {
            const banner = document.getElementById('lastReadBanner');
            const nameEl = document.getElementById('lastReadSuratName');
            const ayahEl = document.getElementById('lastReadAyahNum');
            const linkEl = document.getElementById('lastReadLink');

            nameEl.textContent = lastRead.suratNama || `Surat ke-${lastRead.suratNomor}`;
            ayahEl.textContent = lastRead.ayahNomor || 1;
            linkEl.href = `/quran/surat/${lastRead.suratNomor}#ayat-${lastRead.ayahNomor || 1}`;
            banner.classList.remove('hidden');
        }
    } catch (e) {}
</script>
@endpush
