@extends('layouts.review')

@section('title', 'Terima Kasih - ' . $reviewable->nomor_faktur)

@section('content')
    <div class="min-h-screen relative overflow-hidden">
        {{-- Decorative background --}}
        <div class="absolute inset-0 wood-grain opacity-[0.04] pointer-events-none"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-secondary-container/40 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-6 py-10">
            {{-- Brand --}}
            <div class="flex items-center gap-3 mb-8">
                <div class="w-11 h-11 rounded-2xl bg-primary flex items-center justify-center shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-on-primary">architecture</span>
                </div>
                <div>
                    <p class="font-headline font-extrabold text-primary leading-none">CRM Mebel</p>
                    <p class="text-[10px] text-outline font-medium tracking-widest uppercase">Artisanal Furniture</p>
                </div>
            </div>

            {{-- Success Card --}}
            <div class="bg-surface-container-lowest rounded-3xl p-10 shadow-xl shadow-primary/10 border border-outline-variant/30 max-w-md w-full text-center">
                <div class="w-20 h-20 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-emerald-600 text-5xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>

                <h1 class="font-headline text-2xl font-black text-on-surface mb-2">
                    Terima Kasih Telah Memberikan Ulasan
                </h1>
                <p class="text-sm text-on-surface-variant leading-relaxed mb-3">
                    Ulasan Anda untuk
                    <span class="font-bold text-primary">
                        {{ $reviewable->nomor_faktur }}
                    </span>
                    telah berhasil dikirim.
                </p>
                <p class="text-xs text-outline leading-relaxed">
                    Masukan Anda sangat berarti bagi kami untuk terus meningkatkan kualitas produk dan layanan.
                </p>

                {{-- Rating recap --}}
                @if($reviewable->rating)
                    <div class="mt-6 py-4 px-6 bg-surface-container rounded-2xl flex items-center justify-center gap-2">
                        <span class="font-headline text-2xl font-black text-primary">{{ $reviewable->rating }}</span>
                        <span class="text-[10px] text-outline font-bold uppercase tracking-widest leading-tight">dari<br>5</span>
                        <span class="text-amber-400 text-lg ml-1">{{ str_repeat('★', $reviewable->rating) }}{{ str_repeat('☆', 5 - $reviewable->rating) }}</span>
                    </div>
                @endif

                <div class="mt-8 pt-6 border-t border-outline-variant/30 flex items-center justify-center gap-1 text-on-surface-variant">
                    <span class="material-symbols-outlined text-on-surface-variant text-sm">favorite</span>
                    <span class="text-xs font-medium">Salam hangat dari Tim CRM Mebel</span>
                    <span class="material-symbols-outlined text-on-surface-variant text-sm">favorite</span>
                </div>
            </div>

            <p class="text-center text-xs text-outline mt-8">&copy; {{ date('Y') }} CRM Mebel. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
@endsection