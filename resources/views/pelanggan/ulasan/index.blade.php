@extends('layouts.pelanggan')

@section('title', 'Ulasan Saya')
@section('page-title', 'Ulasan')
@section('page-subtitle', 'Berikan masukan untuk pesanan dan proyek yang telah selesai')

@section('content')
    @if($reviewables->count() > 0)
        <div class="space-y-4">
            @foreach($reviewables as $item)
                <div class="bg-white rounded-2xl border border-outline-variant/20 p-6 {{ !$item->sudah_direview ? 'border-l-4 border-l-amber-400' : '' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ $item->type === 'order' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                <span class="material-symbols-outlined text-xl">{{ $item->type === 'order' ? 'receipt_long' : 'handyman' }}</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-on-surface font-headline">{{ $item->nama }}</h3>
                                <p class="text-xs text-on-surface-variant">
                                    {{ $item->label }} • {{ $item->nomor }}
                                    @if($item->tanggal)
                                        • {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            @if($item->sudah_direview)
                                {{-- Show rating --}}
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-base {{ $i <= $item->rating ? 'text-amber-500' : 'text-outline/30' }}" style="font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                </div>
                                <span class="px-4 py-2 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full">Sudah Direview</span>
                            @else
                                <a href="{{ route('pelanggan.ulasan.create', ['type' => $item->type, 'id' => $item->id]) }}"
                                   class="px-5 py-2.5 bg-primary text-on-primary font-bold text-sm rounded-full hover:bg-primary-container transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">rate_review</span>
                                    Tulis Ulasan
                                </a>
                            @endif
                        </div>
                    </div>

                    @if($item->sudah_direview && $item->keluhan_masukan)
                        <div class="mt-4 pt-4 border-t border-outline-variant/10">
                            <p class="text-sm text-on-surface-variant italic">"{{ $item->keluhan_masukan }}"</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-outline/30 mb-4">rate_review</span>
            <p class="text-on-surface-variant font-medium">Belum ada pesanan atau proyek yang selesai untuk di-review.</p>
        </div>
    @endif
@endsection
