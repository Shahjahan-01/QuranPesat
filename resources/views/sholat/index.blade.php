@extends('layouts.app')

@section('title', 'Jadwal Shalat ' . $selectedKabkota . ' - Nurul Qur\'an')
@section('meta_description', 'Jadwal shalat dan imsakiyah resmi untuk ' . $selectedKabkota . ', ' . $selectedProvinsi . ' bulan ' . ($daftarBulan[$selectedBulan] ?? $selectedBulan) . ' ' . $selectedTahun . '.')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-teal-950 via-teal-900 to-emerald-950 text-white py-12 border-b border-teal-800/40 relative">
    <div class="absolute inset-0 opacity-10 bg-islamic-pattern pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center space-x-2 bg-teal-800/80 text-emerald-200 px-3 py-1 rounded-full text-xs font-semibold border border-teal-700/60 mb-3">
                <i class="fa-solid fa-clock"></i>
                <span>Layanan 03 eQuran.id API (Pengayaan LKPD)</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold font-serif text-white tracking-tight">
                Jadwal Shalat & Imsakiyah
            </h1>
            <p class="text-teal-100/80 text-sm mt-1 max-w-xl">
                Jadwal waktu shalat akurat untuk 34 provinsi dan lebih dari 500 kabupaten/kota di seluruh Indonesia.
            </p>
        </div>

        <div class="flex items-center justify-center sm:justify-end space-x-3 text-xs">
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">{{ count($daftarProvinsi) }}</span>
                <span class="text-teal-200">Provinsi</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-2xl border border-white/15 text-center">
                <span class="block text-amber-300 font-bold text-lg font-mono">517+</span>
                <span class="text-teal-200">Kab / Kota</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    <!-- Filter Form (Provinsi, Kab/Kota, Bulan, Tahun) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xs">
        <form action="{{ route('sholat.filter') }}" method="POST" id="filterSholatForm" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- 1. Pilihan Provinsi (GET) -->
                <div>
                    <label for="provinsiSelect" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        <i class="fa-solid fa-map-location-dot text-teal-600 mr-1"></i> Provinsi:
                    </label>
                    <select name="provinsi" id="provinsiSelect" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 font-medium focus:ring-2 focus:ring-teal-700 focus:outline-none transition">
                        @foreach($daftarProvinsi as $prov)
                        <option value="{{ $prov }}" {{ $selectedProvinsi === $prov ? 'selected' : '' }}>
                            {{ $prov }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. Pilihan Kab/Kota (POST) -->
                <div>
                    <label for="kabkotaSelect" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        <i class="fa-solid fa-city text-teal-600 mr-1"></i> Kab / Kota:
                    </label>
                    <div class="relative">
                        <select name="kabkota" id="kabkotaSelect" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 font-medium focus:ring-2 focus:ring-teal-700 focus:outline-none transition">
                            @foreach($daftarKabkota as $kab)
                            <option value="{{ $kab }}" {{ $selectedKabkota === $kab ? 'selected' : '' }}>
                                {{ $kab }}
                            </option>
                            @endforeach
                        </select>
                        <div id="kabkotaLoading" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-teal-600">
                            <i class="fa-solid fa-circle-notch fa-spin text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- 3. Pilihan Bulan -->
                <div>
                    <label for="bulanSelect" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        <i class="fa-regular fa-calendar text-teal-600 mr-1"></i> Bulan:
                    </label>
                    <select name="bulan" id="bulanSelect" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 font-medium focus:ring-2 focus:ring-teal-700 focus:outline-none transition">
                        @foreach($daftarBulan as $num => $namaBulan)
                        <option value="{{ $num }}" {{ $selectedBulan === $num ? 'selected' : '' }}>
                            {{ $namaBulan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- 4. Pilihan Tahun -->
                <div>
                    <label for="tahunInput" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        <i class="fa-solid fa-calendar-check text-teal-600 mr-1"></i> Tahun:
                    </label>
                    <input type="number" 
                           name="tahun" 
                           id="tahunInput" 
                           value="{{ $selectedTahun }}" 
                           min="2020" 
                           max="2030"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-800 font-medium focus:ring-2 focus:ring-teal-700 focus:outline-none transition">
                </div>
            </div>

            <!-- Submit Button & Print Action -->
            <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs text-slate-500 flex items-center">
                    <i class="fa-solid fa-circle-info text-teal-600 mr-1.5"></i>
                    <span>Parameter dikirim via method POST ke eQuran.id API v2.</span>
                </div>
                <div class="flex items-center space-x-2 w-full sm:w-auto">
                    <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition flex items-center">
                        <i class="fa-solid fa-print mr-1.5 text-slate-500"></i> Cetak Jadwal
                    </button>
                    <button type="submit" class="flex-1 sm:flex-initial px-6 py-2.5 rounded-xl bg-teal-800 hover:bg-teal-900 text-white text-xs font-bold uppercase tracking-wider transition shadow-sm">
                        <i class="fa-solid fa-arrows-rotate mr-1.5"></i> Tampilkan Jadwal
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Error State Alert -->
    @if(!$isSuccess || empty($jadwalData))
    <div class="bg-red-50 border border-red-200 rounded-3xl p-8 text-center text-red-700">
        <i class="fa-solid fa-triangle-exclamation text-3xl text-red-500 mb-2"></i>
        <h3 class="font-bold text-base">Gagal Mengambil Jadwal Shalat</h3>
        <p class="text-xs text-red-600 mt-1 max-w-md mx-auto">
            {{ $errorMessage ?? 'Data jadwal shalat tidak tersedia untuk kombinasi lokasi atau periode yang diminta.' }}
        </p>
        <div class="mt-4 flex justify-center space-x-2">
            <a href="{{ route('sholat.index') }}" class="px-4 py-2 rounded-xl bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition">
                Kembali ke Default
            </a>
        </div>
    </div>
    @else

    @php
        $jadwalList = $jadwalData['jadwal'] ?? [];
        $hariIniTanggal = (int)date('j');
        $bulanSekarang = (int)date('n');
        $tahunSekarang = (int)date('Y');
        $isBulanBerjalan = ($selectedBulan == $bulanSekarang && $selectedTahun == $tahunSekarang);
        
        $todayJadwal = null;
        if ($isBulanBerjalan) {
            foreach ($jadwalList as $j) {
                if ($j['tanggal'] == $hariIniTanggal) {
                    $todayJadwal = $j;
                    break;
                }
            }
        }
        if (!$todayJadwal && !empty($jadwalList)) {
            $todayJadwal = $jadwalList[0];
        }
    @endphp

    <!-- Card Highlight Hari Ini & Next Prayer Countdown -->
    @if($todayJadwal)
    <div class="bg-gradient-to-br from-teal-900 via-emerald-900 to-teal-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-teal-700/50 relative overflow-hidden">
        <div class="absolute inset-0 bg-islamic-pattern opacity-10 pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Info -->
            <div class="lg:col-span-5 space-y-4 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 bg-teal-800/80 text-amber-300 px-3 py-1 rounded-full text-xs font-semibold border border-teal-700/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>{{ $isBulanBerjalan ? 'Waktu Sholat Hari Ini' : 'Cuplikan Awal Bulan' }}</span>
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold font-serif text-white">
                        {{ $jadwalData['kabkota'] }}
                    </h2>
                    <p class="text-xs text-teal-200 mt-1">
                        {{ $todayJadwal['hari'] }}, {{ $todayJadwal['tanggal_lengkap'] }} • Wilayah {{ $jadwalData['provinsi'] }}
                    </p>
                </div>

                <!-- Next Prayer Countdown Box -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/15 text-left">
                    <div class="flex items-center justify-between text-xs text-teal-200 mb-1">
                        <span id="nextPrayerName">Menghitung waktu shalat...</span>
                        <span id="nextPrayerTarget" class="font-mono text-amber-300 font-bold">--:--</span>
                    </div>
                    <div class="text-xl sm:text-2xl font-bold font-mono text-amber-300" id="nextPrayerCountdown">
                        00:00:00
                    </div>
                    <p class="text-[11px] text-teal-200/70 mt-1">
                        Dihitung berdasarkan jam lokal perangkat Anda.
                    </p>
                </div>
            </div>

            <!-- Right: 8 Times Grid -->
            <div class="lg:col-span-7">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Imsak</span>
                        <span class="text-xl font-bold font-mono text-white mt-1 block">{{ $todayJadwal['imsak'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Subuh</span>
                        <span class="text-xl font-bold font-mono text-amber-300 mt-1 block">{{ $todayJadwal['subuh'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Terbit</span>
                        <span class="text-xl font-bold font-mono text-white mt-1 block">{{ $todayJadwal['terbit'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Dhuha</span>
                        <span class="text-xl font-bold font-mono text-white mt-1 block">{{ $todayJadwal['dhuha'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Dzuhur</span>
                        <span class="text-xl font-bold font-mono text-amber-300 mt-1 block">{{ $todayJadwal['dzuhur'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Ashar</span>
                        <span class="text-xl font-bold font-mono text-amber-300 mt-1 block">{{ $todayJadwal['ashar'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Maghrib</span>
                        <span class="text-xl font-bold font-mono text-amber-300 mt-1 block">{{ $todayJadwal['maghrib'] }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/10 hover:border-amber-400/50 transition">
                        <span class="text-teal-200 text-xs block font-medium">Isya</span>
                        <span class="text-xl font-bold font-mono text-amber-300 mt-1 block">{{ $todayJadwal['isya'] }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    <!-- Tabel Jadwal Sholat Satu Bulan Penuh -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="p-6 sm:p-7 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-serif">
                    Jadwal Shalat Bulanan {{ $daftarBulan[$selectedBulan] ?? $selectedBulan }} {{ $selectedTahun }}
                </h3>
                <p class="text-xs text-slate-500">
                    Lokasi: <span class="font-semibold text-slate-700">{{ $jadwalData['kabkota'] }}</span>, Provinsi <span class="font-semibold text-slate-700">{{ $jadwalData['provinsi'] }}</span>
                </p>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-500">
                <span class="w-3 h-3 rounded-full bg-emerald-100 border border-emerald-400 inline-block"></span>
                <span>Baris berwarna hijau menandai hari ini</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 text-center">Tgl</th>
                        <th class="py-3.5 px-4">Hari</th>
                        <th class="py-3.5 px-3 text-center">Imsak</th>
                        <th class="py-3.5 px-3 text-center">Subuh</th>
                        <th class="py-3.5 px-3 text-center">Terbit</th>
                        <th class="py-3.5 px-3 text-center">Dhuha</th>
                        <th class="py-3.5 px-3 text-center">Dzuhur</th>
                        <th class="py-3.5 px-3 text-center">Ashar</th>
                        <th class="py-3.5 px-3 text-center">Maghrib</th>
                        <th class="py-3.5 px-3 text-center">Isya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($jadwalList as $row)
                    @php
                        $isTodayRow = ($isBulanBerjalan && $row['tanggal'] == $hariIniTanggal);
                    @endphp
                    <tr class="transition {{ $isTodayRow ? 'bg-emerald-50/80 font-bold text-emerald-950 border-l-4 border-l-emerald-700' : 'hover:bg-slate-50 text-slate-700' }}">
                        <td class="py-3 px-4 text-center font-mono">
                            <span class="{{ $isTodayRow ? 'w-7 h-7 rounded-full bg-emerald-800 text-white inline-flex items-center justify-center' : '' }}">
                                {{ $row['tanggal'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4 whitespace-nowrap">
                            {{ $row['hari'] }}
                            @if($isTodayRow)
                            <span class="ml-1.5 px-2 py-0.5 rounded text-[10px] bg-emerald-700 text-white font-medium">Hari Ini</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 text-center font-mono text-slate-600">{{ $row['imsak'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-emerald-800 font-semibold">{{ $row['subuh'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-slate-500">{{ $row['terbit'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-slate-500">{{ $row['dhuha'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-emerald-800 font-semibold">{{ $row['dzuhur'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-emerald-800 font-semibold">{{ $row['ashar'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-amber-700 font-semibold">{{ $row['maghrib'] }}</td>
                        <td class="py-3 px-3 text-center font-mono text-emerald-800 font-semibold">{{ $row['isya'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    // AJAX Dynamic Kabkota dropdown when provinsi changed
    const provSelect = document.getElementById('provinsiSelect');
    const kabSelect = document.getElementById('kabkotaSelect');
    const kabLoading = document.getElementById('kabkotaLoading');

    if (provSelect && kabSelect) {
        provSelect.addEventListener('change', async (e) => {
            const selectedProv = e.target.value;
            kabLoading.classList.remove('hidden');
            kabSelect.disabled = true;

            try {
                const response = await fetch("{{ route('sholat.kabkota.ajax') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ provinsi: selectedProv })
                });

                const data = await response.json();
                if (data.success && Array.isArray(data.data)) {
                    kabSelect.innerHTML = '';
                    data.data.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item;
                        opt.textContent = item;
                        kabSelect.appendChild(opt);
                    });
                }
            } catch (err) {
                console.error('Error fetching kabkota:', err);
            } finally {
                kabLoading.classList.add('hidden');
                kabSelect.disabled = false;
            }
        });
    }

    // Realtime Next Prayer Countdown
    @if(isset($todayJadwal) && $todayJadwal)
    const times = {
        'Subuh': "{{ $todayJadwal['subuh'] }}",
        'Terbit': "{{ $todayJadwal['terbit'] }}",
        'Dzuhur': "{{ $todayJadwal['dzuhur'] }}",
        'Ashar': "{{ $todayJadwal['ashar'] }}",
        'Maghrib': "{{ $todayJadwal['maghrib'] }}",
        'Isya': "{{ $todayJadwal['isya'] }}"
    };

    function updatePrayerCountdown() {
        const now = new Date();
        const nowMinutes = now.getHours() * 60 + now.getMinutes();
        const nowSeconds = now.getSeconds();

        let nextPrayer = null;
        let nextTargetMinutes = null;

        for (const [name, timeStr] of Object.entries(times)) {
            const parts = timeStr.split(':');
            const targetMin = parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
            if (targetMin > nowMinutes) {
                nextPrayer = name;
                nextTargetMinutes = targetMin;
                break;
            }
        }

        // If after Isya, next is Subuh tomorrow
        let isTomorrow = false;
        if (!nextPrayer) {
            nextPrayer = 'Subuh (Besok)';
            const parts = times['Subuh'].split(':');
            nextTargetMinutes = parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10) + (24 * 60);
            isTomorrow = true;
        }

        const diffMinutes = nextTargetMinutes - nowMinutes - 1;
        const diffSeconds = 60 - nowSeconds;

        const hours = Math.floor(diffMinutes / 60);
        const minutes = diffMinutes % 60;
        const seconds = diffSeconds === 60 ? 0 : diffSeconds;

        const pad = (n) => String(n).padStart(2, '0');
        const formatted = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;

        const nameEl = document.getElementById('nextPrayerName');
        const targetEl = document.getElementById('nextPrayerTarget');
        const countdownEl = document.getElementById('nextPrayerCountdown');

        if (nameEl) nameEl.textContent = `Menuju Adzan ${nextPrayer}`;
        if (targetEl) targetEl.textContent = times[nextPrayer.replace(' (Besok)', '')] || '--:--';
        if (countdownEl) countdownEl.textContent = formatted;
    }

    updatePrayerCountdown();
    setInterval(updatePrayerCountdown, 1000);
    @endif
</script>
@endpush
