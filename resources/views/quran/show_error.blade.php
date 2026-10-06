@extends('layouts.app')

@section('title', 'Surat Tidak Ditemukan - Nurul Qur\'an')

@section('content')
<div class="max-w-xl mx-auto px-4 py-20 text-center">
    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-md">
        <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-3xl mx-auto mb-4 border border-amber-200">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h2 class="text-xl font-bold text-slate-900 font-serif">Data Surat Gagal Dimuat</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-2">
            {{ $message ?? 'Surat nomor ' . $nomor . ' tidak dapat diambil dari server eQuran.id.' }}
        </p>
        <div class="mt-6 flex items-center justify-center space-x-3">
            <a href="{{ route('quran.index') }}" class="px-5 py-2.5 rounded-xl bg-emerald-800 text-white text-xs font-bold hover:bg-emerald-900 transition">
                <i class="fa-solid fa-arrow-left mr-1.5"></i> Kembali ke Daftar Surat
            </a>
            <a href="javascript:location.reload()" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200 transition">
                <i class="fa-solid fa-arrows-rotate mr-1"></i> Coba Lagi
            </a>
        </div>
    </div>
</div>
@endsection
