@extends('layouts.app')

@section('title', $doa['nama'] . ' - Nurul Qur\'an')
@section('meta_description', 'Baca ' . $doa['nama'] . ' lengkap teks Arab, latin, arti, dan riwayat sanad hadits shahih.')

@section('content')
<!-- Header Banner -->
<div class="bg-gradient-to-r from-amber-950 via-amber-900 to-emerald-950 text-white py-12 border-b border-amber-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 bg-amber-800/80 text-amber-200 px-3.5 py-1.5 rounded-full text-xs font-semibold border border-amber-700/60 mb-3">
            <span>{{ $doa['grup'] ?? 'Doa Harian' }}</span>
            <span>•</span>
            <span>ID #{{ $doa['id'] }}</span>
        </div>
        <h1 class="text-2xl sm:text-4xl font-extrabold font-serif text-white tracking-tight">
            {{ $doa['nama'] }}
        </h1>
        <div class="flex items-center justify-center space-x-2 mt-4 text-xs text-amber-200">
            <a href="{{ route('doa.index') }}" class="hover:text-white underline">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Kumpulan Doa
            </a>
        </div>
    </div>
</div>

<!-- Main Doa Detail Container -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 space-y-8">

    <!-- Big Card Doa -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-md space-y-8">
        
        <!-- Action Bar -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div class="flex items-center space-x-2">
                @if(!empty($doa['tag']) && is_array($doa['tag']))
                    @foreach($doa['tag'] as $t)
                    <a href="{{ route('doa.index', ['tag' => $t]) }}" class="text-xs bg-amber-50 text-amber-800 border border-amber-200 px-3 py-1 rounded-full font-medium hover:bg-amber-100 transition">
                        #{{ $t }}
                    </a>
                    @endforeach
                @endif
            </div>

            <button type="button" 
                    onclick="copyFullDoa()"
                    class="inline-flex items-center space-x-1.5 px-4 py-2 rounded-xl bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold transition shadow-xs">
                <i class="fa-regular fa-copy"></i>
                <span>Salin Doa Lengkap</span>
            </button>
        </div>

        <!-- Teks Arab -->
        <div class="bg-parchment-pattern p-6 sm:p-10 rounded-3xl border border-amber-900/10 text-center">
            <p class="font-arabic text-2xl sm:text-3xl lg:text-4xl text-slate-900 leading-[2.6]" dir="rtl" id="doaArabic">
                {{ $doa['ar'] }}
            </p>
        </div>

        <!-- Transliterasi Latin -->
        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-amber-700">
                <i class="fa-solid fa-align-left mr-1"></i> Transliterasi Latin
            </h4>
            <div class="bg-amber-50/60 p-4 sm:p-5 rounded-2xl border border-amber-100">
                <p class="text-sm sm:text-base text-amber-950 font-medium italic leading-relaxed" id="doaLatin">
                    {{ $doa['tr'] }}
                </p>
            </div>
        </div>

        <!-- Terjemahan Bahasa Indonesia -->
        <div class="space-y-2">
            <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-800">
                <i class="fa-solid fa-language mr-1"></i> Terjemahan Bahasa Indonesia
            </h4>
            <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-100">
                <p class="text-sm sm:text-base text-slate-800 leading-relaxed" id="doaTerjemah">
                    "{{ $doa['idn'] }}"
                </p>
            </div>
        </div>

        <!-- Sumber Hadits & Penjelasan -->
        @if(!empty($doa['tentang']))
        <div class="space-y-2 pt-4 border-t border-slate-100">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">
                <i class="fa-solid fa-scroll mr-1"></i> Sanad Hadits & Catatan
            </h4>
            <div class="bg-slate-50/80 p-4 sm:p-5 rounded-2xl border border-slate-200 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                {{ $doa['tentang'] }}
            </div>
        </div>
        @endif
    </div>

    <!-- Doa Terkait -->
    @if(!empty($doaTerkait))
    <div class="space-y-4 pt-6">
        <h3 class="text-lg font-bold text-slate-900 font-serif">
            Doa Terkait Dalam Kategori Ini
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($doaTerkait as $rel)
            <a href="{{ route('doa.show', $rel['id']) }}" class="bg-white p-5 rounded-2xl border border-slate-200 hover:border-amber-400 hover:shadow-md transition block group">
                <span class="text-[11px] font-bold text-amber-700 block mb-1">Doa #{{ $rel['id'] }}</span>
                <h4 class="font-bold text-sm text-slate-900 group-hover:text-amber-800 transition line-clamp-1">
                    {{ $rel['nama'] }}
                </h4>
                <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                    {{ $rel['idn'] }}
                </p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>

<!-- Toast -->
<div id="toastNotification" class="fixed top-24 right-5 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center space-x-2 text-xs pointer-events-none">
    <i class="fa-solid fa-circle-check text-amber-400"></i>
    <span id="toastMessage">Doa berhasil disalin</span>
</div>
@endsection

@push('scripts')
<script>
    function copyFullDoa() {
        const arabic = document.getElementById('doaArabic').innerText;
        const latin = document.getElementById('doaLatin').innerText;
        const terjemah = document.getElementById('doaTerjemah').innerText;
        const title = "{{ $doa['nama'] }}";

        const full = `*${title}*\n\n${arabic}\n\n${latin}\n\n${terjemah}\n\n(Sumber: eQuran.id - Doa Harian)`;
        navigator.clipboard.writeText(full).then(() => {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (toast && toastMsg) {
                toastMsg.textContent = `Doa berhasil disalin ke clipboard!`;
                toast.classList.remove('opacity-0', 'translate-y-[-100px]');
                toast.classList.add('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'translate-y-[-100px]');
                }, 3000);
            }
        });
    }
</script>
@endpush
