@extends('layouts.app')

@section('title', 'Kumpulan Doa Harian & Dzikir - Nurul Qur\'an')
@section('meta_description', 'Kumpulan 227+ doa harian dan dzikir shahih bersumber dari Hisnul Muslim lengkap dengan teks Arab, latin, terjemahan, dan perawi hadits.')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-amber-950 via-amber-900 to-emerald-950 text-white py-12 border-b border-amber-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center space-x-2 bg-amber-800/80 text-amber-200 px-3 py-1 rounded-full text-xs font-semibold border border-amber-700/60 mb-3">
                <i class="fa-solid fa-hands-praying"></i>
                <span>Layanan 02 eQuran.id API</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold font-serif text-white tracking-tight">
                Kumpulan Doa Harian & Dzikir
            </h1>
            <p class="text-amber-100/80 text-sm mt-1 max-w-xl">
                227+ Doa bersumber dari hadits-hadits shahih (Hisnul Muslim). Dilengkapi teks Arab berharakat, transliterasi Latin, terjemahan, dan rujukan sanad.
            </p>
        </div>

        <div class="flex items-center justify-center sm:justify-end space-x-3 text-xs">
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">{{ $totalSemua }}</span>
                <span class="text-amber-200">Total Doa</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">{{ count($allTags) }}</span>
                <span class="text-amber-200">Kategori Tag</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Search & Filter Controls -->
    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200 shadow-xs mb-8 space-y-4">
        <form action="{{ route('doa.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <!-- Search Input -->
            <div class="md:col-span-8 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" 
                       id="searchDoaInput"
                       name="q" 
                       value="{{ $search }}"
                       placeholder="Cari doa, arti, atau riwayat hadits (contoh: tidur, orang tua, rezeki, perlindungan)..."
                       class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-transparent transition">
            </div>

            <!-- Submit & Reset -->
            <div class="md:col-span-4 flex items-center space-x-2">
                <button type="submit" class="flex-1 py-3 px-4 rounded-xl bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold uppercase tracking-wider transition">
                    Cari Doa
                </button>
                @if(!empty($search) || !empty($selectedTag))
                <a href="{{ route('doa.index') }}" class="p-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs transition" title="Reset Pencarian">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                @endif
            </div>
        </form>

        <!-- Category / Tag Pills Filter -->
        <div class="pt-2 border-t border-slate-100">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-2">
                Pilih Kategori Doa:
            </span>
            <div class="flex flex-wrap gap-1.5">
                <a href="{{ route('doa.index', ['q' => $search]) }}" 
                   class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ empty($selectedTag) ? 'bg-amber-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua Kategori
                </a>
                @foreach($allTags as $tag)
                <a href="{{ route('doa.index', ['tag' => $tag, 'q' => $search]) }}" 
                   class="px-3 py-1.5 rounded-xl text-xs font-semibold transition {{ $selectedTag === $tag ? 'bg-amber-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    #{{ $tag }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Error State Alert -->
    @if(!$isSuccess)
    <div class="bg-red-50 border border-red-200 rounded-3xl p-6 mb-8 text-center text-red-700">
        <i class="fa-solid fa-triangle-exclamation text-3xl text-red-500 mb-2"></i>
        <h3 class="font-bold text-base">Gagal Mengambil Data Doa</h3>
        <p class="text-xs text-red-600 mt-1">{{ $errorMessage ?? 'Koneksi ke endpoint API Doa eQuran.id terputus.' }}</p>
        <a href="{{ route('doa.index') }}" class="mt-4 inline-block px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition">
            <i class="fa-solid fa-arrows-rotate mr-1"></i> Coba Muat Ulang
        </a>
    </div>
    @endif

    <!-- Doa Results Counter -->
    <div class="flex items-center justify-between text-xs text-slate-500 mb-4 px-2">
        <span>Menampilkan <strong>{{ $totalDitemukan }}</strong> dari total {{ $totalSemua }} doa</span>
        @if(!empty($selectedTag))
        <span class="bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full font-medium">Tag: #{{ $selectedTag }}</span>
        @endif
    </div>

    <!-- Doa Cards Grid -->
    @if(count($doaList) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="doaGrid">
        @foreach($doaList as $doa)
        <div class="doa-card bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 hover:border-amber-400 hover:shadow-lg transition-all duration-200 flex flex-col justify-between group"
             data-nama="{{ strtolower($doa['nama']) }}"
             data-idn="{{ strtolower($doa['idn']) }}"
             data-tr="{{ strtolower($doa['tr']) }}">
            
            <div class="space-y-4">
                <!-- Card Header -->
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-800 font-bold text-xs flex items-center justify-center font-mono border border-amber-200">
                            {{ $doa['id'] }}
                        </span>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                            {{ $doa['grup'] ?? 'Doa Harian' }}
                        </span>
                    </div>

                    <div class="flex items-center space-x-1">
                        <button type="button" 
                                onclick="copyDoa('{{ addslashes($doa['nama']) }}', '{{ addslashes($doa['ar']) }}', '{{ addslashes($doa['idn']) }}', this)"
                                class="p-2 rounded-lg bg-slate-50 hover:bg-amber-50 text-slate-500 hover:text-amber-700 border border-slate-200 transition text-xs" 
                                title="Salin Doa & Makna">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                        <a href="{{ route('doa.show', $doa['id']) }}" 
                           class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-800 border border-slate-200 transition text-xs"
                           title="Halaman Detail & Riwayat">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-800 transition font-serif">
                    <a href="{{ route('doa.show', $doa['id']) }}">
                        {{ $doa['nama'] }}
                    </a>
                </h3>

                <!-- Arabic Text Box -->
                <div class="bg-parchment-pattern p-5 rounded-2xl border border-amber-900/10">
                    <p class="font-arabic text-xl sm:text-2xl text-slate-900 leading-loose" dir="rtl">
                        {{ $doa['ar'] }}
                    </p>
                </div>

                <!-- Latin Transliteration -->
                <p class="text-xs text-amber-900 font-medium italic leading-relaxed">
                    {{ $doa['tr'] }}
                </p>

                <!-- Translation -->
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                    {{ $doa['idn'] }}
                </p>

                <!-- Source / Hadith Reference (if available) -->
                @if(!empty($doa['tentang']))
                <div class="pt-2 border-t border-slate-100">
                    <p class="text-[11px] text-slate-500 line-clamp-2">
                        <strong class="text-slate-700">Rujukan:</strong> {{ $doa['tentang'] }}
                    </p>
                </div>
                @endif
            </div>

            <!-- Footer Tags & Detail Link -->
            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <div class="flex flex-wrap gap-1">
                    @if(!empty($doa['tag']) && is_array($doa['tag']))
                        @foreach($doa['tag'] as $t)
                        <a href="{{ route('doa.index', ['tag' => $t]) }}" class="text-[10px] bg-amber-50 text-amber-800 border border-amber-200 px-2 py-0.5 rounded hover:bg-amber-100 transition">
                            #{{ $t }}
                        </a>
                        @endforeach
                    @endif
                </div>

                <a href="{{ route('doa.show', $doa['id']) }}" class="font-bold text-amber-800 hover:text-amber-950 inline-flex items-center">
                    Detail Lengkap <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-lg mx-auto">
        <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center text-2xl mx-auto mb-4 border border-amber-200">
            <i class="fa-solid fa-hands-praying"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Doa Tidak Ditemukan</h3>
        <p class="text-xs text-slate-500 mt-1">
            Tidak ditemukan doa untuk pencarian "{{ $search }}". Cobalah kata kunci umum seperti tidur, makan, perjalanan, orang tua, dsb.
        </p>
        <a href="{{ route('doa.index') }}" class="mt-5 inline-block px-5 py-2.5 rounded-xl bg-amber-700 text-white text-xs font-bold hover:bg-amber-800 transition">
            Tampilkan Seluruh Doa
        </a>
    </div>
    @endif

</div>

<!-- Toast Notification -->
<div id="toastNotification" class="fixed top-24 right-5 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center space-x-2 text-xs pointer-events-none">
    <i class="fa-solid fa-circle-check text-amber-400"></i>
    <span id="toastMessage">Doa berhasil disalin</span>
</div>
@endsection

@push('scripts')
<script>
    function copyDoa(nama, arabic, idn, btn) {
        const text = `*${nama}*\n\n${arabic}\n\n"${idn}"\n\n(Sumber: eQuran.id - Doa Harian)`;
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (toast && toastMsg) {
                toastMsg.textContent = `Doa "${nama}" berhasil disalin!`;
                toast.classList.remove('opacity-0', 'translate-y-[-100px]');
                toast.classList.add('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'translate-y-[-100px]');
                }, 3000);
            }
        });
    }

    // Client-side quick filter
    const searchDoaInput = document.getElementById('searchDoaInput');
    const doaCards = document.querySelectorAll('.doa-card');
    if (searchDoaInput && doaCards.length > 0) {
        searchDoaInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase().trim();
            doaCards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                const idn = card.getAttribute('data-idn');
                const tr = card.getAttribute('data-tr');
                if (nama.includes(val) || idn.includes(val) || tr.includes(val)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>
@endpush
