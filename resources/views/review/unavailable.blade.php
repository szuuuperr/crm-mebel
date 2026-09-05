@extends('layouts.review')

@section('title', 'Review Tidak Tersedia')

@section('content')
    <div class="min-h-screen relative overflow-hidden flex items-center justify-center">
        <div class="absolute inset-0 wood-grain opacity-[0.04] pointer-events-none"></div>

        <div class="relative z-10 max-w-md w-full mx-auto px-6">
            <div class="text-center mb-6">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-primary flex items-center justify-center shadow-lg shadow-primary/20 mb-3">
                    <span class="material-symbols-outlined text-on-primary">architecture</span>
                </div>
                <p class="font-headline font-extrabold text-primary leading-none">CRM Mebel</p>
            </div>

            <div class="bg-surface-container-lowest rounded-3xl p-10 shadow-xl shadow-primary/10 border border-outline-variant/30 text-center">
                <div class="w-16 h-16 mx-auto bg-error-container rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-error text-4xl">shield_lock</span>
                </div>
                <h1 class="font-headline text-xl font-black text-on-surface mb-2">Review Tidak Tersedia</h1>
                <p class="text-sm text-on-surface-variant leading-relaxed">
                    Link review ini tidak dapat diakses. Mohon pastikan pesanan/proyek Anda sudah selesai
                    atau hubungi tim kami untuk bantuan.
                </p>
            </div>

            <p class="text-center text-xs text-outline mt-6">&copy; {{ date('Y') }} CRM Mebel. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
@endsection