<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['displayName'] ?? 'Roblox Player' }} - Profil Roblox</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Space Grotesk"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0e1117] text-[#e6edf3] font-sans min-h-screen flex flex-col justify-between selection:bg-[#238636] selection:text-white">

    <!-- Top Navigation -->
    <header class="border-b border-[#21262d] bg-[#161b22]/90 backdrop-blur-md sticky top-0 z-20">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            
            <!-- Logo / Brand -->
            <a href="/roblox" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#e6edf3] flex items-center justify-center font-black text-[#0e1117] shadow-sm transform -rotate-3 hover:rotate-0 transition-transform">
                    <span class="text-xl leading-none">R</span>
                </div>
                <div>
                    <span class="font-display font-bold text-base tracking-tight text-white block">Roblox Explorer</span>
                    <span class="text-[11px] text-[#7d8590] block">Official Public API Explorer</span>
                </div>
            </a>

            <!-- Search Form -->
            <form action="/roblox" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-72">
                    <input type="text" 
                           name="username" 
                           value="{{ $searchUsername }}" 
                           placeholder="Cari username Roblox..." 
                           class="w-full bg-[#0d1117] border border-[#30363d] focus:border-[#58a6ff] focus:ring-1 focus:ring-[#58a6ff] rounded-lg px-3.5 py-2 text-sm text-[#e6edf3] placeholder-[#6e7681] outline-none transition-colors">
                </div>
                <button type="submit" 
                        class="px-4 py-2 bg-[#238636] hover:bg-[#2ea043] text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center gap-1.5 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke-width="2"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>
                    </svg>
                    <span>Cari</span>
                </button>
            </form>

            <!-- Nav Links -->
            <div class="flex items-center gap-4 text-xs text-[#8b949e]">
                <a href="/" class="hover:text-white transition-colors">Quote App</a>
                <span>&bull;</span>
                <a href="/produk" class="hover:text-white transition-colors">API Produk</a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-4xl mx-auto px-6 py-10 w-full my-auto">
        
        @if ($error)
            <div class="bg-[#1f191b] border border-[#f85149]/40 rounded-xl p-6 text-center max-w-lg mx-auto">
                <div class="w-12 h-12 rounded-full bg-[#f85149]/10 text-[#f85149] mx-auto flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-white mb-1">Pengguna Tidak Ditemukan</h3>
                <p class="text-sm text-[#8b949e] mb-4">{{ $error }}</p>
                <a href="/roblox?username=Roblox" class="text-xs text-[#58a6ff] hover:underline font-semibold">Coba lihat profil default: Roblox</a>
            </div>
        @elseif ($profile)
            
            <div class="bg-[#161b22] border border-[#30363d] rounded-2xl overflow-hidden shadow-xl">
                
                <!-- Banner Strip -->
                <div class="h-28 bg-gradient-to-r from-[#1f242c] via-[#242b35] to-[#1a202c] relative">
                    <div class="absolute top-4 right-4 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ ($profile['isBanned'] ?? false) ? 'bg-[#f85149]/20 text-[#f85149] border border-[#f85149]/40' : 'bg-[#238636]/20 text-[#3fb950] border border-[#238636]/40' }}">
                            <span class="w-2 h-2 rounded-full {{ ($profile['isBanned'] ?? false) ? 'bg-[#f85149]' : 'bg-[#3fb950]' }}"></span>
                            {{ ($profile['isBanned'] ?? false) ? 'Banned' : 'Akun Aktif' }}
                        </span>
                    </div>
                </div>

                <!-- Profile Info Row -->
                <div class="px-6 sm:px-10 pb-10 relative">
                    
                    <div class="flex flex-col md:flex-row items-center md:items-end justify-between -mt-16 sm:-mt-20 gap-6 pb-8 border-b border-[#21262d]">
                        
                        <!-- Avatar & Basic Names -->
                        <div class="flex flex-col sm:flex-row items-center sm:items-end gap-5 text-center sm:text-left">
                            <div class="relative group">
                                <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-2xl bg-[#0d1117] border-4 border-[#161b22] shadow-2xl overflow-hidden flex items-center justify-center">
                                    @if ($avatarHeadshot)
                                        <img src="{{ $avatarHeadshot }}" alt="{{ $profile['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-3xl font-bold text-[#7d8590]">{{ substr($profile['name'], 0, 1) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="sm:mb-2">
                                <div class="flex items-center justify-center sm:justify-start gap-2">
                                    <h1 class="text-2xl sm:text-3xl font-display font-bold text-white tracking-tight">{{ $profile['displayName'] }}</h1>
                                    @if ($profile['hasVerifiedBadge'] ?? false)
                                        <span title="Terverifikasi" class="text-[#58a6ff]">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-[#7d8590] font-mono mt-0.5">@<span>{{ $profile['name'] }}</span> &bull; <span class="text-xs">ID: {{ $profile['id'] }}</span></p>
                            </div>
                        </div>

                        <!-- External Profile Link -->
                        <div class="flex items-center gap-3">
                            <a href="https://www.roblox.com/users/{{ $profile['id'] }}/profile" 
                               target="_blank" 
                               class="px-4 py-2 bg-[#21262d] hover:bg-[#30363d] text-[#c9d1d9] hover:text-white rounded-lg text-xs font-semibold transition-colors flex items-center gap-1.5 border border-[#30363d]">
                                <span>Buka Profil Roblox</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Details & Avatar Model View -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                        
                        <!-- Left 2 Cols: Stats, Bio, Join Date -->
                        <div class="lg:col-span-2 space-y-6">
                            
                            <!-- Stats Box -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <div class="bg-[#0d1117] border border-[#21262d] rounded-xl p-4">
                                    <div class="text-[11px] uppercase tracking-wider text-[#7d8590] font-semibold">Pengikut / Followers</div>
                                    <div class="text-xl font-display font-bold text-white mt-1">{{ number_format($followersCount) }}</div>
                                </div>
                                <div class="bg-[#0d1117] border border-[#21262d] rounded-xl p-4">
                                    <div class="text-[11px] uppercase tracking-wider text-[#7d8590] font-semibold">Teman / Friends</div>
                                    <div class="text-xl font-display font-bold text-white mt-1">{{ number_format($friendsCount) }}</div>
                                </div>
                                <div class="bg-[#0d1117] border border-[#21262d] rounded-xl p-4 col-span-2 sm:col-span-1">
                                    <div class="text-[11px] uppercase tracking-wider text-[#7d8590] font-semibold">Bergabung Sejak</div>
                                    <div class="text-sm font-semibold text-white mt-1.5">
                                        {{ isset($profile['created']) ? date('d M Y', strtotime($profile['created'])) : '-' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Bio / Description -->
                            <div class="bg-[#0d1117] border border-[#21262d] rounded-xl p-5">
                                <h3 class="text-xs uppercase tracking-wider text-[#7d8590] font-semibold mb-3">Tentang Pengguna (Bio)</h3>
                                <p class="text-sm text-[#c9d1d9] leading-relaxed whitespace-pre-line font-normal">
                                    {{ !empty($profile['description']) ? $profile['description'] : 'Pengguna ini belum menuliskan deskripsi / bio profil.' }}
                                </p>
                            </div>

                            <!-- Quick Preset Suggestions -->
                            <div>
                                <div class="text-xs text-[#7d8590] mb-2 font-medium">Coba cari akun populer lainnya:</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach (['Builderman', 'David.Baszucki', 'KreekCraft', 'Flamingo', 'Denis'] as $popularUser)
                                        <a href="/roblox?username={{ $popularUser }}" 
                                           class="px-3 py-1 rounded-md text-xs bg-[#21262d] hover:bg-[#30363d] text-[#c9d1d9] border border-[#30363d] transition-colors">
                                            {{ $popularUser }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <!-- Right 1 Col: Full Body Avatar Visual -->
                        <div class="bg-[#0d1117] border border-[#21262d] rounded-xl p-5 flex flex-col items-center justify-between text-center">
                            <span class="text-xs uppercase tracking-wider text-[#7d8590] font-semibold mb-2">Avatar 3D Karakter</span>
                            
                            <div class="w-full flex items-center justify-center my-auto py-2">
                                @if ($avatarFull)
                                    <img src="{{ $avatarFull }}" alt="Avatar Penuh {{ $profile['name'] }}" class="max-h-64 object-contain filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.6)]">
                                @else
                                    <p class="text-xs text-[#7d8590]">Model avatar tidak tersedia</p>
                                @endif
                            </div>

                            <span class="text-[11px] text-[#7d8590] mt-3">Rendered via Roblox Thumbnails API</span>
                        </div>

                    </div>

                </div>

            </div>

        @endif

    </main>

    <!-- Footer -->
    <footer class="border-t border-[#21262d] py-6 text-center text-xs text-[#7d8590]">
        <div class="max-w-4xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>Roblox Profile Explorer &bull; Laravel HTTP Client</span>
            <span>Data bersumber dari API resmi Roblox (Tanpa Token/Gratis)</span>
        </div>
    </footer>

</body>
</html>
