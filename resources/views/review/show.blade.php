@extends('layouts.review')

@section('title', 'Beri Penilaian - ' . $reviewable->nomor_faktur)

@section('content')
    <div class="min-h-screen relative overflow-hidden">
        {{-- Decorative background --}}
        <div class="absolute inset-0 wood-grain opacity-[0.04] pointer-events-none"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-primary/5 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-secondary-container/40 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-xl mx-auto px-6 py-10">
            {{-- Brand --}}
            <div class="flex justify-center mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-primary flex items-center justify-center shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-on-primary">architecture</span>
                    </div>
                    <div>
                        <p class="font-headline font-extrabold text-primary leading-none">CRM Mebel</p>
                        <p class="text-[10px] text-outline font-medium tracking-widest uppercase">Artisanal Furniture</p>
                    </div>
                </div>
            </div>

            {{-- Error messages --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-error-container/60 rounded-2xl">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm font-medium text-on-error-container flex items-start gap-2">
                                <span class="material-symbols-outlined text-[18px] mt-0.5">error</span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Hero Card --}}
            <div class="bg-primary rounded-3xl p-8 mb-6 relative overflow-hidden shadow-xl shadow-primary/20">
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <span class="material-symbols-outlined text-[160px]">{{ $type === 'order' ? 'receipt_long' : 'carpenter' }}</span>
                </div>
                <div class="relative z-10">
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 text-on-primary text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">
                        <span class="material-symbols-outlined text-sm">star</span>
                        Beri Penilaian
                    </span>
                    <h1 class="font-headline text-3xl font-black text-on-primary leading-tight mb-2">
                        Terima kasih, <br>{{ $reviewable->customer->nama ?? 'Pelanggan' }}!
                    </h1>
                    <p class="text-on-primary/80 text-sm leading-relaxed">
                        Kami senang dapat melayani Anda. Bagaimana pengalaman Anda dengan
                        {{ $type === 'order' ? 'pesanan' : 'proyek' }}
                        <span class="font-bold text-on-primary">#{{ $reviewable->nomor_faktur }}</span>?
                    </p>
                </div>
            </div>

            {{-- Order/Project Summary --}}
            <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm mb-6 border border-outline-variant/30">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold text-outline uppercase tracking-widest">
                        {{ $type === 'order' ? 'Ringkasan Pesanan' : 'Ringkasan Proyek' }}
                    </span>
                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider rounded-full">Selesai</span>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-on-surface-variant">Pelanggan</span>
                        <span class="font-bold text-on-surface">{{ $reviewable->customer->nama }}</span>
                    </div>
                    @if($type === 'order')
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Item</span>
                            <span class="font-bold text-on-surface">{{ $reviewable->items->pluck('product.nama_produk')->join(', ') ?: '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Total</span>
                            <span class="font-headline font-black text-primary">{{ $reviewable->total_format }}</span>
                        </div>
                    @else
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface-variant">Nama Proyek</span>
                            <span class="font-bold text-on-surface">{{ $reviewable->nama }}</span>
                        </div>
                        @if($reviewable->tanggal_selesai)
                            <div class="flex justify-between items-center">
                                <span class="text-on-surface-variant">Tanggal Selesai</span>
                                <span class="font-bold text-on-surface">{{ $reviewable->tanggal_selesai->translatedFormat('d M Y') }}</span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Review Form --}}
            <div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/30">
                <form action="{{ route('review.submit', $identifier) }}" method="POST" id="reviewForm">
                    @csrf
                    <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', '') }}">

                    {{-- Rating Stars --}}
                    <div class="mb-8">
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Rating Anda</label>
                        <div class="flex items-center justify-center gap-2 py-4" id="starContainer">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-value="{{ $i }}"
                                    class="rating-star group transition-transform hover:scale-110 focus:outline-none {{ old('rating') >= $i ? 'text-amber-400' : 'text-outline-variant' }}"
                                    aria-label="{{ $i }} bintang">
                                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <p class="text-center text-sm font-medium text-on-surface-variant mt-2" id="ratingLabel">
                            {{ old('rating') ? ['','Sangat Kurang','Kurang','Cukup','Puas','Sangat Puas'][old('rating')] : 'Pilih bintang untuk memberi rating' }}
                        </p>
                    </div>

                    {{-- Textarea --}}
                    <div class="mb-6">
                        <label for="keluhan_masukan" class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">
                            Keluhan / Masukan
                        </label>
                        <textarea name="keluhan_masukan" id="keluhan_masukan" rows="5" required minlength="10" maxlength="2000"
                            class="w-full px-4 py-3 bg-surface-container-high rounded-2xl border-none focus:ring-2 focus:ring-primary focus:bg-white resize-none text-on-surface font-medium text-sm"
                            placeholder="Tuliskan pengalaman, kendala, atau masukan Anda...">{{ old('keluhan_masukan') }}</textarea>
                        <div class="flex justify-between mt-1 text-[10px] text-outline">
                            <span>Minimal 10 karakter</span>
                            <span id="charCount">0 / 2000</span>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full py-4 bg-primary text-on-primary font-headline font-bold rounded-full hover:scale-[1.01] hover:shadow-lg hover:shadow-primary/25 active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">send</span>
                        Kirim Penilaian
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-outline mt-8 space-y-1">
                <span class="block flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">lock</span>
                    Review Anda tersimpan secara aman
                </span>
                <span>&copy; {{ date('Y') }} CRM Mebel. Seluruh hak cipta dilindungi.</span>
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            // Star rating interaction
            const ratingInput = document.getElementById('ratingValue');
            const stars = document.querySelectorAll('.rating-star');
            const ratingLabel = document.getElementById('ratingLabel');
            const labels = ['', 'Sangat Kurang', 'Kurang', 'Cukup', 'Puas', 'Sangat Puas'];

            function updateStars(value) {
                stars.forEach(star => {
                    const v = parseInt(star.dataset.value);
                    star.classList.toggle('text-amber-400', v <= value);
                    star.classList.toggle('text-outline-variant', v > value);
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.dataset.value);
                    ratingInput.value = value;
                    updateStars(value);
                    ratingLabel.textContent = labels[value];
                });
                star.addEventListener('mouseenter', () => {
                    const value = parseInt(star.dataset.value);
                    stars.forEach(s => {
                        const v = parseInt(s.dataset.value);
                        s.classList.toggle('text-amber-400', v <= value);
                        s.classList.toggle('text-outline-variant', v > value);
                    });
                });
                star.addEventListener('mouseleave', () => {
                    updateStars(parseInt(ratingInput.value) || 0);
                });
            });

            // Char counter
            const textarea = document.getElementById('keluhan_masukan');
            const charCount = document.getElementById('charCount');
            textarea.addEventListener('input', () => {
                charCount.textContent = `${textarea.value.length} / 2000`;
            });

            // Validate rating before submit
            document.getElementById('reviewForm').addEventListener('submit', (e) => {
                if (!ratingInput.value) {
                    e.preventDefault();
                    ratingLabel.textContent = 'Silakan pilih rating terlebih dahulu';
                    ratingLabel.classList.add('text-error');
                    stars[0].classList.add('animate-pulse');
                    setTimeout(() => {
                        ratingLabel.classList.remove('text-error');
                        stars[0].classList.remove('animate-pulse');
                    }, 2000);
                    return;
                }
            });
        </script>
    @endpush
@endsection
