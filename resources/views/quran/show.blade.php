@extends('layouts.app')

@section('title', 'Surat ' . $surat['namaLatin'] . ' (' . $surat['nama'] . ') - Nurul Qur\'an')
@section('meta_description', 'Baca Surat ' . $surat['namaLatin'] . ' (' . $surat['arti'] . ') ' . $surat['jumlahAyat'] . ' ayat lengkap teks Arab, latin, terjemahan, audio murottal 6 Qari, dan tafsir Kemenag RI.')

@section('content')
<!-- Surah Hero Card Header -->
<div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 text-white py-12 lg:py-16 border-b border-emerald-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <!-- Breadcrumb / Surah Number Badge -->
        <div class="inline-flex items-center space-x-2 bg-emerald-800/80 text-amber-300 px-4 py-1.5 rounded-full text-xs font-semibold border border-emerald-700/60 mb-4">
            <span>Surat ke-{{ $surat['nomor'] }}</span>
            <span>•</span>
            <span>{{ $surat['tempatTurun'] }}</span>
            <span>•</span>
            <span>{{ $surat['jumlahAyat'] }} Ayat</span>
        </div>

        <!-- Surah Title & Arabic -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-serif text-white tracking-tight mb-2">
            {{ $surat['namaLatin'] }}
        </h1>
        <p class="font-arabic text-3xl sm:text-4xl lg:text-5xl text-amber-300 my-4" dir="rtl">
            {{ $surat['nama'] }}
        </p>
        <p class="text-emerald-100/90 text-base sm:text-lg italic">
            "{{ $surat['arti'] }}"
        </p>

        <!-- Deskripsi Ringkas / Toggle Info -->
        <div class="mt-6 max-w-2xl mx-auto">
            <details class="group bg-white/10 backdrop-blur-md rounded-2xl border border-white/15 text-left text-xs transition duration-200">
                <summary class="cursor-pointer px-5 py-3 font-semibold text-emerald-200 hover:text-white flex items-center justify-between list-none">
                    <span><i class="fa-solid fa-circle-info mr-2 text-amber-400"></i> Latar Belakang & Deskripsi Surat</span>
                    <i class="fa-solid fa-chevron-down text-[10px] group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="px-5 pb-4 pt-1 text-emerald-100/80 leading-relaxed border-t border-white/10 prose prose-invert max-w-none text-xs">
                    {!! $surat['deskripsi'] !!}
                </div>
            </details>
        </div>

        <!-- Audio Player Surat Controls (6 Qari Selector) -->
        <div class="mt-8 bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-emerald-500/30 max-w-2xl mx-auto">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="w-full sm:w-auto text-left">
                    <label for="qariSelect" class="block text-[11px] uppercase tracking-wider text-emerald-300 font-bold mb-1">
                        <i class="fa-solid fa-microphone-lines mr-1 text-amber-400"></i> Pilih Qari Murottal:
                    </label>
                    <select id="qariSelect" class="bg-emerald-950/80 border border-emerald-700 text-white rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-amber-400 focus:outline-none w-full sm:w-64">
                        @foreach($qariList as $code => $name)
                        <option value="{{ $code }}" {{ $code === '05' ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full sm:w-auto flex items-center justify-center space-x-3">
                    <button type="button" 
                            id="playFullSurahBtn"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-xs uppercase tracking-wider transition transform active:scale-95 shadow-md">
                        <i class="fa-solid fa-play mr-2" id="playFullSurahIcon"></i>
                        <span>Putar Surat Penuh</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Container with Tabs -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10">

    <!-- View Mode Tabs (Ayat & Terjemah vs Tafsir) -->
    <div class="flex items-center justify-center space-x-2 border-b border-slate-200 mb-8 pb-4">
        <button type="button" 
                id="tabAyatBtn" 
                onclick="switchTab('ayat')"
                class="px-5 py-2.5 rounded-xl text-sm font-bold transition flex items-center space-x-2 bg-emerald-800 text-white shadow-xs">
            <i class="fa-solid fa-book-open"></i>
            <span>Ayat & Terjemahan ({{ $surat['jumlahAyat'] }})</span>
        </button>

        <button type="button" 
                id="tabTafsirBtn" 
                onclick="switchTab('tafsir')"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center space-x-2 bg-slate-100 text-slate-600 hover:bg-slate-200">
            <i class="fa-solid fa-feather-pointed"></i>
            <span>Tafsir Kemenag RI</span>
        </button>
    </div>

    <!-- TAB 1: AYAT & TERJEMAHAN -->
    <div id="contentAyat" class="space-y-6">

        <!-- Bismillah Banner (Kecuali Surat ke-9 At-Taubah dan Surat ke-1 Al-Fatihah yang sudah punya bismillah di ayat 1) -->
        @if($surat['nomor'] != 9 && $surat['nomor'] != 1)
        <div class="bg-white rounded-3xl p-8 text-center border border-slate-200/80 shadow-xs relative overflow-hidden">
            <div class="absolute inset-0 bg-parchment-pattern opacity-40"></div>
            <div class="relative z-10">
                <span class="font-arabic text-3xl sm:text-4xl text-slate-900 block" dir="rtl">
                    بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ
                </span>
                <p class="text-xs text-slate-500 mt-2 italic font-serif">
                    Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang
                </p>
            </div>
        </div>
        @endif

        <!-- Ayat List -->
        @foreach($surat['ayat'] as $ayat)
        <div id="ayat-{{ $ayat['nomorAyat'] }}" 
             class="ayah-card bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 hover:border-emerald-600/50 shadow-xs hover:shadow-md transition-all duration-200 space-y-6 group">
            
            <!-- Ayat Header Bar (Tools: Play Audio, Copy, Bookmark) -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div class="flex items-center space-x-3">
                    <!-- Ayah Number Motif -->
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center font-bold text-sm font-mono shadow-2xs group-hover:bg-emerald-800 group-hover:text-amber-300 transition duration-200">
                        {{ $ayat['nomorAyat'] }}
                    </div>
                    <span class="text-xs font-semibold text-slate-500">
                        {{ $surat['namaLatin'] }} : {{ $ayat['nomorAyat'] }}
                    </span>
                </div>

                <!-- Ayat Action Buttons -->
                <div class="flex items-center space-x-1.5 sm:space-x-2">
                    <!-- Play Ayah Audio -->
                    <button type="button" 
                            data-ayah="{{ $ayat['nomorAyat'] }}"
                            data-audio='@json($ayat['audio'])'
                            onclick="playSingleAyah({{ $ayat['nomorAyat'] }}, this)"
                            class="ayah-play-btn p-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 text-emerald-800 border border-slate-200 hover:border-emerald-300 transition text-xs flex items-center space-x-1"
                            title="Putar Audio Ayat Ini">
                        <i class="fa-solid fa-play text-xs text-emerald-700"></i>
                        <span class="hidden sm:inline text-[11px] font-semibold">Dengar</span>
                    </button>

                    <!-- Copy Ayah Text -->
                    <button type="button" 
                            onclick="copyAyahText('{{ addslashes($ayat['teksArab']) }}', '{{ addslashes($ayat['teksIndonesia']) }}', {{ $ayat['nomorAyat'] }}, this)"
                            class="p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 border border-slate-200 transition text-xs"
                            title="Salin Ayat & Terjemah">
                        <i class="fa-regular fa-copy"></i>
                    </button>

                    <!-- Bookmark Last Read -->
                    <button type="button" 
                            onclick="saveLastRead({{ $surat['nomor'] }}, '{{ addslashes($surat['namaLatin']) }}', {{ $ayat['nomorAyat'] }}, this)"
                            class="p-2.5 rounded-xl bg-slate-50 hover:bg-amber-50 text-slate-600 hover:text-amber-600 border border-slate-200 hover:border-amber-300 transition text-xs"
                            title="Tandai Terakhir Dibaca">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                </div>
            </div>

            <!-- Arabic Text -->
            <div class="py-2">
                <p class="ayah-arabic leading-[2.6] tracking-wide" dir="rtl">
                    {{ $ayat['teksArab'] }}
                    <span class="inline-flex items-center justify-center w-9 h-9 mx-1.5 rounded-full border border-amber-600/40 text-amber-700 font-mono text-xs font-bold bg-amber-50/60 align-middle">
                        {{ $ayat['nomorAyat'] }}
                    </span>
                </p>
            </div>

            <!-- Latin & Indonesian Translation -->
            <div class="space-y-2 pt-2 border-t border-slate-100">
                <p class="text-xs sm:text-sm text-emerald-900 font-medium italic leading-relaxed">
                    {{ $ayat['teksLatin'] }}
                </p>
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                    {{ $ayat['teksIndonesia'] }}
                </p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- TAB 2: TAFSIR KEMENAG RI -->
    <div id="contentTafsir" class="hidden space-y-6">
        @if($tafsir && !empty($tafsir['tafsir']))
        <div class="bg-emerald-50 rounded-2xl p-5 border border-emerald-200 text-xs text-emerald-900 leading-relaxed mb-6">
            <div class="flex items-center space-x-2 font-bold mb-1">
                <i class="fa-solid fa-book-bookmark text-emerald-700"></i>
                <span>Tafsir Tahlili Kemenag RI</span>
            </div>
            Penjelasan tafsir mendalam ayat demi ayat bersumber dari Kementerian Agama Republik Indonesia (Kemenag RI) melalui API resmi eQuran.id.
        </div>

        @foreach($tafsir['tafsir'] as $t)
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs space-y-4">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-3">
                <span class="w-8 h-8 rounded-lg bg-emerald-800 text-amber-300 font-bold text-xs flex items-center justify-center font-mono">
                    {{ $t['ayat'] }}
                </span>
                <h4 class="font-bold text-sm text-slate-900">
                    Tafsir Surat {{ $surat['namaLatin'] }} : Ayat {{ $t['ayat'] }}
                </h4>
            </div>
            <div class="text-xs sm:text-sm text-slate-700 leading-loose prose max-w-none space-y-3 whitespace-pre-line">
                {{ $t['teks'] }}
            </div>
        </div>
        @endforeach
        @else
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 text-slate-500">
            <i class="fa-solid fa-triangle-exclamation text-3xl text-amber-500 mb-2"></i>
            <p class="text-sm">Tafsir untuk surat ini belum tersedia dari server eQuran.id.</p>
        </div>
        @endif
    </div>

    <!-- Surah Footer Navigation (Prev / Next) -->
    <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        @if(!empty($surat['suratSebelumnya']))
        <a href="{{ route('quran.show', $surat['suratSebelumnya']['nomor']) }}" 
           class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-white border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50 text-slate-700 hover:text-emerald-900 font-semibold text-xs transition shadow-xs">
            <i class="fa-solid fa-chevron-left mr-2"></i>
            <span>Sebelumnya: {{ $surat['suratSebelumnya']['namaLatin'] }}</span>
        </a>
        @else
        <div class="hidden sm:block"></div>
        @endif

        <a href="{{ route('quran.index') }}" 
           class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-emerald-800 text-white font-bold text-xs uppercase tracking-wider hover:bg-emerald-900 transition shadow-sm">
            <i class="fa-solid fa-grid mr-2"></i>
            <span>Daftar Seluruh Surat</span>
        </a>

        @if(!empty($surat['suratSelanjutnya']))
        <a href="{{ route('quran.show', $surat['suratSelanjutnya']['nomor']) }}" 
           class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-white border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50 text-slate-700 hover:text-emerald-900 font-semibold text-xs transition shadow-xs">
            <span>Selanjutnya: {{ $surat['suratSelanjutnya']['namaLatin'] }}</span>
            <i class="fa-solid fa-chevron-right ml-2"></i>
        </a>
        @else
        <div class="hidden sm:block"></div>
        @endif
    </div>

</div>

<!-- Toast Notification -->
<div id="toastNotification" class="fixed top-24 right-5 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center space-x-2 text-xs pointer-events-none">
    <i class="fa-solid fa-circle-check text-emerald-400"></i>
    <span id="toastMessage">Berhasil</span>
</div>
@endsection

@push('scripts')
<script>
    // Audio full surat mapping
    const audioFullList = @json($surat['audioFull']);
    const qariNames = @json($qariList);
    const surahName = "{{ $surat['namaLatin'] }}";

    // Play Full Surah
    const playFullBtn = document.getElementById('playFullSurahBtn');
    const qariSelect = document.getElementById('qariSelect');

    if (playFullBtn && qariSelect) {
        playFullBtn.addEventListener('click', () => {
            const selectedQari = qariSelect.value;
            const audioUrl = audioFullList[selectedQari] || audioFullList['05'] || audioFullList['01'];
            const qariName = qariNames[selectedQari] || 'Qari Pilihan';

            if (audioUrl) {
                window.audioEngine.playAudio(
                    audioUrl, 
                    `Surat ${surahName} (Lengkap)`, 
                    `Qari: ${qariName}`, 
                    playFullBtn
                );
            }
        });
    }

    // Play Single Ayah
    function playSingleAyah(ayahNumber, btn) {
        const audioMap = JSON.parse(btn.getAttribute('data-audio'));
        const selectedQari = qariSelect.value;
        const audioUrl = audioMap[selectedQari] || audioMap['05'] || audioMap['01'];
        const qariName = qariNames[selectedQari] || 'Misyari Rasyid Al-Afasi';

        if (audioUrl) {
            window.audioEngine.playAudio(
                audioUrl, 
                `Surat ${surahName} (Ayat ${ayahNumber})`, 
                `Qari: ${qariName}`, 
                btn
            );
        }
    }

    // Switch Tabs
    function switchTab(mode) {
        const tabAyat = document.getElementById('tabAyatBtn');
        const tabTafsir = document.getElementById('tabTafsirBtn');
        const contentAyat = document.getElementById('contentAyat');
        const contentTafsir = document.getElementById('contentTafsir');

        if (mode === 'ayat') {
            tabAyat.className = "px-5 py-2.5 rounded-xl text-sm font-bold transition flex items-center space-x-2 bg-emerald-800 text-white shadow-xs";
            tabTafsir.className = "px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center space-x-2 bg-slate-100 text-slate-600 hover:bg-slate-200";
            contentAyat.classList.remove('hidden');
            contentTafsir.classList.add('hidden');
        } else {
            tabTafsir.className = "px-5 py-2.5 rounded-xl text-sm font-bold transition flex items-center space-x-2 bg-emerald-800 text-white shadow-xs";
            tabAyat.className = "px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center space-x-2 bg-slate-100 text-slate-600 hover:bg-slate-200";
            contentTafsir.classList.remove('hidden');
            contentAyat.classList.add('hidden');
        }
    }

    // Copy Ayah
    function copyAyahText(arabic, indonesian, ayahNum, btn) {
        const fullText = `${arabic}\n\n"${indonesian}"\n(QS. ${surahName} : ${ayahNum})`;
        navigator.clipboard.writeText(fullText).then(() => {
            showToast(`Ayat ${ayahNum} berhasil disalin!`);
        });
    }

    // Save Last Read
    function saveLastRead(suratNomor, suratNama, ayahNomor, btn) {
        const item = {
            suratNomor: suratNomor,
            suratNama: suratNama,
            ayahNomor: ayahNomor,
            timestamp: new Date().toISOString()
        };
        localStorage.setItem('nurul_last_read', JSON.stringify(item));
        showToast(`Tanda baca tersimpan pada Surat ${suratNama} Ayat ${ayahNomor}`);
    }

    // Toast Notification Helper
    function showToast(message) {
        const toast = document.getElementById('toastNotification');
        const toastMsg = document.getElementById('toastMessage');
        if (toast && toastMsg) {
            toastMsg.textContent = message;
            toast.classList.remove('opacity-0', 'translate-y-[-100px]');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-[-100px]');
            }, 3000);
        }
    }
</script>
@endpush
