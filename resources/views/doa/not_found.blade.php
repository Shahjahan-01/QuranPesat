@extends('layouts.app')

@section('title', 'Doa Tidak Ditemukan - Nurul Qur\'an')

@section('content')
<div class="max-w-xl mx-auto px-4 py-20 text-center">
    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-md">
        <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-3xl mx-auto mb-4 border border-amber-200">
            <i class="fa-solid fa-hands-praying"></i>
        </div>
        <h2 class="text-xl font-bold text-slate-900 font-serif">Doa Tidak Ditemukan</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-2">
            Doa dengan ID #{{ $id }} tidak ditemukan dalam database atau repositori doa eQuran.id.
        </p>
        <div class="mt-6 flex items-center justify-center space-x-3">
            <a href="{{ route('doa.index') }}" class="px-5 py-2.5 rounded-xl bg-amber-700 text-white text-xs font-bold hover:bg-amber-800 transition">
                <i class="fa-solid fa-arrow-left mr-1.5"></i> Lihat Kumpulan Doa
            </a>
        </div>
    </div>
</div>
@endsection
