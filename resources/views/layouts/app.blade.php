<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nurul Qur\'an - Portal Al-Qur\'an, Doa & Jadwal Sholat')</title>
    <meta name="description" content="@yield('meta_description', 'Portal Website Islami terlengkap dengan integrasi API eQuran.id: Al-Qur\'an 30 Juz, Tafsir Kemenag, Doa Harian, dan Jadwal Shalat se-Indonesia.')">

    <!-- Google Fonts: Amiri (Arab Mushaf), Plus Jakarta Sans (Latin Modern) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Scheherazade+New:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-parchment-pattern text-slate-800 font-sans antialiased min-h-screen flex flex-col selection:bg-emerald-700 selection:text-white pb-20 md:pb-0">

    <!-- Top Notice Bar (Nuansa Islami & Identitas LKPD) -->
    <div class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 text-emerald-200 text-xs py-2 px-4 border-b border-emerald-800/60 hidden sm:block">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-emerald-800/80 text-emerald-200 border border-emerald-700">
                    <i class="fa-solid fa-graduation-cap mr-1.5 text-amber-400"></i> Qur'an Pesat
                </span>
                <span>Website Islami</span>
            </div>
            <div class="flex items-center space-x-4 text-emerald-300/80">
                <span id="currentDateDisplay"><i class="fa-regular fa-calendar-days mr-1.5 text-emerald-400"></i> Memuat tanggal...</span>
                <span>•</span>
                <span class="font-arabic text-amber-300" dir="rtl">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3.5 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-800 to-emerald-950 flex items-center justify-center text-amber-400 shadow-md shadow-emerald-900/20 group-hover:scale-105 transition-transform duration-200 border border-emerald-700/40">
                        <i class="fa-solid fa-quran text-2xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1.5">
                            <span class="text-2xl font-bold tracking-tight text-emerald-950 font-serif">Nurul Qur'an</span>
                            
                        </div>
                        <p class="text-xs text-slate-500 font-medium tracking-wide">Portal Al-Qur'an, Doa & Sholat</p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('home') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800 font-bold border border-emerald-200' : 'text-slate-600 hover:text-emerald-800 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-house-chimney text-xs mr-1.5 text-emerald-600"></i> Beranda
                    </a>
                    
                    <a href="{{ route('quran.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('quran.*') ? 'bg-emerald-50 text-emerald-800 font-bold border border-emerald-200' : 'text-slate-600 hover:text-emerald-800 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-book-quran text-xs mr-1.5 text-emerald-600"></i> Al-Qur'an & Tafsir
                    </a>
                    
                    <a href="{{ route('doa.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('doa.*') ? 'bg-emerald-50 text-emerald-800 font-bold border border-emerald-200' : 'text-slate-600 hover:text-emerald-800 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-hands-praying text-xs mr-1.5 text-emerald-600"></i> Doa Harian
                    </a>
                    
                    <a href="{{ route('sholat.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('sholat.*') ? 'bg-emerald-50 text-emerald-800 font-bold border border-emerald-200' : 'text-slate-600 hover:text-emerald-800 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-clock text-xs mr-1.5 text-emerald-600"></i> Jadwal Sholat
                    </a>

                    <div class="h-6 w-px bg-slate-200 mx-2"></div>

                    

                    
                </nav>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden space-x-2">
                    <a href="{{ route('laporan') }}" class="p-2 rounded-lg bg-amber-50 text-amber-800 text-xs border border-amber-200">
                        <i class="fa-solid fa-file-lines"></i>
                    </a>
                    <button id="mobileMenuBtn" type="button" class="p-2.5 rounded-xl text-slate-700 hover:text-emerald-800 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-700">
                        <i class="fa-solid fa-bars text-xl" id="menuOpenIcon"></i>
                        <i class="fa-solid fa-xmark text-xl hidden" id="menuCloseIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('home') ? 'bg-emerald-800 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                <i class="fa-solid fa-house-chimney w-6 text-center mr-2"></i> Beranda
            </a>
            <a href="{{ route('quran.index') }}" class="flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('quran.*') ? 'bg-emerald-800 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                <i class="fa-solid fa-book-quran w-6 text-center mr-2"></i> Al-Qur'an & Tafsir
            </a>
            <a href="{{ route('doa.index') }}" class="flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('doa.*') ? 'bg-emerald-800 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                <i class="fa-solid fa-hands-praying w-6 text-center mr-2"></i> Doa Harian
            </a>
            <a href="{{ route('sholat.index') }}" class="flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('sholat.*') ? 'bg-emerald-800 text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                <i class="fa-solid fa-clock w-6 text-center mr-2"></i> Jadwal Sholat
            </a>
            <a href="{{ route('laporan') }}" class="flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-amber-50 text-amber-900 border border-amber-200">
                <i class="fa-solid fa-file-lines w-6 text-center mr-2 text-amber-600"></i> Lembar Kerja Siswa (LKPD)
            </a>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Global Floating Sticky Audio Player -->
    <div id="globalAudioPlayer" class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-emerald-900/10 shadow-2xl transition-all duration-300 transform translate-y-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex flex-col sm:flex-row items-center justify-between gap-3">
            <!-- Audio Info -->
            <div class="flex items-center space-x-3 w-full sm:w-auto">
                <div class="w-10 h-10 rounded-xl bg-emerald-800 text-amber-300 flex items-center justify-center shrink-0 shadow-sm relative">
                    <i class="fa-solid fa-volume-high text-lg"></i>
                    <!-- Animated sound wave bars -->
                    <div id="audioEqualizer" class="absolute inset-0 flex items-center justify-center space-x-0.5 bg-emerald-900/90 rounded-xl hidden">
                        <span class="playing-bar w-0.5 bg-amber-300"></span>
                        <span class="playing-bar w-0.5 bg-amber-300"></span>
                        <span class="playing-bar w-0.5 bg-amber-300"></span>
                        <span class="playing-bar w-0.5 bg-amber-300"></span>
                    </div>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 id="audioTitle" class="text-sm font-bold text-slate-800 truncate">Al-Fatihah (Ayat 1)</h4>
                    <p id="audioSubtitle" class="text-xs text-slate-500 truncate">Qari: Misyari Rasyid Al-Afasi</p>
                </div>
            </div>

            <!-- Controls & Progress -->
            <div class="flex items-center justify-center space-x-4 w-full sm:w-1/2">
                <button id="audioRewind10" type="button" class="text-slate-500 hover:text-emerald-800 transition" title="Mundur 5 detik">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>

                <button id="audioPlayPauseBtn" type="button" class="w-11 h-11 rounded-full bg-emerald-800 hover:bg-emerald-900 text-amber-300 flex items-center justify-center shadow-md shadow-emerald-900/20 transition transform active:scale-95">
                    <i class="fa-solid fa-play text-lg ml-0.5" id="audioPlayIcon"></i>
                    <i class="fa-solid fa-pause text-lg hidden" id="audioPauseIcon"></i>
                </button>

                <button id="audioForward10" type="button" class="text-slate-500 hover:text-emerald-800 transition" title="Maju 5 detik">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>

                <!-- Seek Bar -->
                <div class="flex items-center space-x-2 flex-1 max-w-xs">
                    <span id="audioCurrentTime" class="text-[11px] font-mono text-slate-500">00:00</span>
                    <input id="audioProgressBar" type="range" min="0" max="100" value="0" class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-emerald-700">
                    <span id="audioDuration" class="text-[11px] font-mono text-slate-500">00:00</span>
                </div>
            </div>

            <!-- Volume & Close -->
            <div class="flex items-center space-x-3 w-full sm:w-auto justify-end">
                <div class="hidden lg:flex items-center space-x-1.5 text-slate-500">
                    <i class="fa-solid fa-volume-low text-xs"></i>
                    <input id="audioVolumeBar" type="range" min="0" max="1" step="0.05" value="1" class="w-16 h-1 bg-slate-200 rounded appearance-none cursor-pointer accent-emerald-700">
                </div>
                <button id="audioCloseBtn" type="button" class="p-2 text-slate-400 hover:text-slate-700 rounded-lg hover:bg-slate-100 transition" title="Tutup Pemutar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
        <!-- Hidden Native Audio Element -->
        <audio id="nativeAudioElement" preload="none"></audio>
    </div>

    <!-- Islamic Footer -->
    <footer class="bg-gradient-to-b from-emerald-950 to-slate-950 text-white mt-16 border-t border-emerald-800/40">
        <!-- Top Wave / Motif Accent -->
        <div class="h-1.5 bg-gradient-to-r from-amber-400 via-emerald-500 to-amber-400 opacity-80"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Col 1: Identity -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-800 flex items-center justify-center text-amber-400 border border-emerald-700">
                            <i class="fa-solid fa-quran text-xl"></i>
                        </div>
                        <span class="text-2xl font-serif font-bold text-white tracking-tight">Nurul Qur'an</span>
                    </div>
                    <p class="text-emerald-100/70 text-sm leading-relaxed max-w-md">
                        Aplikasi web islami komprehensif yang mengintegrasikan layanan resmi <strong>eQuran.id API v2</strong>. Dirancang secara profesional, mudah digunakan, cepat, dan sarat faedah bagi umat Islam untuk tilawah, tadabbur, berdoa, dan menjaga waktu shalat.
                    </p>
                    
                </div>

                <!-- Col 2: Layanan Fitur -->
                <div class="space-y-3">
                    <h5 class="text-sm font-semibold uppercase tracking-wider text-amber-400">Layanan Website</h5>
                    <ul class="space-y-2 text-sm text-emerald-100/70">
                        <li>
                            <a href="{{ route('quran.index') }}" class="hover:text-amber-300 transition flex items-center">
                                <i class="fa-solid fa-chevron-right text-[10px] mr-2 text-emerald-500"></i> Al-Qur'an 30 Juz
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quran.show', 1) }}" class="hover:text-amber-300 transition flex items-center">
                                <i class="fa-solid fa-chevron-right text-[10px] mr-2 text-emerald-500"></i> Audio Tilawah 6 Qari
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('doa.index') }}" class="hover:text-amber-300 transition flex items-center">
                                <i class="fa-solid fa-chevron-right text-[10px] mr-2 text-emerald-500"></i> 227+ Doa Harian & Dzikir
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sholat.index') }}" class="hover:text-amber-300 transition flex items-center">
                                <i class="fa-solid fa-chevron-right text-[10px] mr-2 text-emerald-500"></i> Jadwal Shalat Indonesia
                            </a>
                        </li>
                    </ul>
                </div>

             
                
            </div>

            <!-- Bottom Subfooter -->
            <div class="mt-12 pt-8 border-t border-emerald-900/60 flex flex-col sm:flex-row items-center justify-between text-xs text-emerald-200/50 gap-4">
                <p>&copy; {{ date('Y') }} Nurul Qur'an • Dibuat dengan khusyuk untuk Proyek Website Islami RPL.</p>
                <p class="font-arabic text-sm text-emerald-300/70" dir="rtl">وَمَا تَوْفِيقِي إِلَّا بِاللَّهِ</p>
            </div>
        </div>
    </footer>

    <!-- Global Scripts -->
    <script>
        // Realtime Local Clock & Date
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = now.toLocaleDateString('id-ID', options);
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            const el = document.getElementById('currentDateDisplay');
            if (el) {
                el.innerHTML = `<i class="fa-regular fa-calendar-days mr-1.5 text-emerald-400"></i> ${dateStr} • <i class="fa-regular fa-clock ml-1 mr-1 text-emerald-400"></i> ${timeStr}`;
            }
        }
        updateClock();
        setInterval(updateClock, 30000);

        // Mobile Menu Toggle
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const openIcon = document.getElementById('menuOpenIcon');
        const closeIcon = document.getElementById('menuCloseIcon');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                openIcon.classList.toggle('hidden', !isHidden);
                closeIcon.classList.toggle('hidden', isHidden);
            });
        }

        // Global Audio Player Engine
        window.audioEngine = {
            element: document.getElementById('nativeAudioElement'),
            playerContainer: document.getElementById('globalAudioPlayer'),
            titleEl: document.getElementById('audioTitle'),
            subtitleEl: document.getElementById('audioSubtitle'),
            playIcon: document.getElementById('audioPlayIcon'),
            pauseIcon: document.getElementById('audioPauseIcon'),
            progressBar: document.getElementById('audioProgressBar'),
            currentTimeEl: document.getElementById('audioCurrentTime'),
            durationEl: document.getElementById('audioDuration'),
            volumeBar: document.getElementById('audioVolumeBar'),
            equalizer: document.getElementById('audioEqualizer'),
            currentAyahBtn: null,

            init() {
                if (!this.element) return;

                // Play / Pause toggle
                document.getElementById('audioPlayPauseBtn')?.addEventListener('click', () => this.togglePlay());
                document.getElementById('audioCloseBtn')?.addEventListener('click', () => this.stopAndClose());
                document.getElementById('audioRewind10')?.addEventListener('click', () => this.seekBy(-5));
                document.getElementById('audioForward10')?.addEventListener('click', () => this.seekBy(5));

                this.element.addEventListener('timeupdate', () => this.onTimeUpdate());
                this.element.addEventListener('loadedmetadata', () => this.onMetadataLoaded());
                this.element.addEventListener('ended', () => this.onEnded());
                this.element.addEventListener('play', () => this.setPlayState(true));
                this.element.addEventListener('pause', () => this.setPlayState(false));

                if (this.progressBar) {
                    this.progressBar.addEventListener('input', (e) => {
                        if (this.element.duration) {
                            this.element.currentTime = (e.target.value / 100) * this.element.duration;
                        }
                    });
                }

                if (this.volumeBar) {
                    this.volumeBar.addEventListener('input', (e) => {
                        this.element.volume = e.target.value;
                    });
                }
            },

            playAudio(src, title, subtitle, triggerButton = null) {
                if (!src) return;

                // Reset previous button icon if any
                if (this.currentAyahBtn && this.currentAyahBtn !== triggerButton) {
                    this.resetButtonIcon(this.currentAyahBtn);
                }
                this.currentAyahBtn = triggerButton;

                this.titleEl.textContent = title || 'Audio Tilawah';
                this.subtitleEl.textContent = subtitle || 'eQuran.id Audio Player';

                this.element.src = src;
                this.element.play().catch(e => {
                    console.error('Audio play error:', e);
                });

                // Show player
                this.playerContainer.classList.remove('translate-y-full');
            },

            togglePlay() {
                if (this.element.paused) {
                    this.element.play();
                } else {
                    this.element.pause();
                }
            },

            stopAndClose() {
                this.element.pause();
                this.element.currentTime = 0;
                this.playerContainer.classList.add('translate-y-full');
                if (this.currentAyahBtn) {
                    this.resetButtonIcon(this.currentAyahBtn);
                    this.currentAyahBtn = null;
                }
            },

            seekBy(seconds) {
                if (this.element.duration) {
                    this.element.currentTime = Math.max(0, Math.min(this.element.duration, this.element.currentTime + seconds));
                }
            },

            setPlayState(isPlaying) {
                this.playIcon.classList.toggle('hidden', isPlaying);
                this.pauseIcon.classList.toggle('hidden', !isPlaying);
                this.equalizer.classList.toggle('hidden', !isPlaying);

                if (this.currentAyahBtn) {
                    const icon = this.currentAyahBtn.querySelector('i');
                    if (icon) {
                        icon.className = isPlaying ? 'fa-solid fa-pause text-amber-500' : 'fa-solid fa-play text-emerald-700';
                    }
                }
            },

            resetButtonIcon(btn) {
                const icon = btn.querySelector('i');
                if (icon) {
                    icon.className = 'fa-solid fa-play text-emerald-700';
                }
            },

            onMetadataLoaded() {
                this.durationEl.textContent = this.formatTime(this.element.duration);
            },

            onTimeUpdate() {
                if (!this.element.duration) return;
                const percent = (this.element.currentTime / this.element.duration) * 100;
                this.progressBar.value = percent;
                this.currentTimeEl.textContent = this.formatTime(this.element.currentTime);
            },

            onEnded() {
                this.setPlayState(false);
                this.progressBar.value = 0;
                this.currentTimeEl.textContent = '00:00';
            },

            formatTime(seconds) {
                if (isNaN(seconds)) return '00:00';
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60);
                return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            }
        };

        window.addEventListener('DOMContentLoaded', () => {
            window.audioEngine.init();
        });
    </script>
    @stack('scripts')
</body>
</html>
