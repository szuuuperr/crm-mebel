@extends('layouts.pelanggan')

@section('title', 'Tulis Ulasan')
@section('page-title', 'Tulis Ulasan')
@section('page-subtitle', $type === 'order' ? 'Pesanan #' . $reviewable->nomor_faktur : $reviewable->nama)

@section('content')
    {{-- Back --}}
    <a href="{{ route('pelanggan.ulasan.index') }}" class="inline-flex items-center gap-2 text-sm text-on-surface-variant hover:text-primary transition-colors mb-6">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Kembali ke Ulasan
    </a>

    <div class="max-w-2xl mx-auto">
        {{-- Item Info --}}
        <div class="bg-white rounded-2xl border border-outline-variant/20 p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center {{ $type === 'order' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                    <span class="material-symbols-outlined text-2xl">{{ $type === 'order' ? 'receipt_long' : 'handyman' }}</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-on-surface font-headline">
                        {{ $type === 'order' ? 'Pesanan #' . $reviewable->nomor_faktur : $reviewable->nama }}
                    </h3>
                    <p class="text-sm text-on-surface-variant">
                        {{ $type === 'order' ? 'Pesanan' : 'Proyek' }} • {{ $reviewable->nomor_faktur }}
                        • Status: <span class="font-bold text-emerald-600">Selesai</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Review Form --}}
        <form method="POST" action="{{ route('pelanggan.ulasan.store', ['type' => $type, 'id' => $reviewable->id]) }}"
              class="bg-white rounded-2xl border border-outline-variant/20 p-8">
            @csrf

            {{-- Rating --}}
            <div class="mb-8">
                <label class="block text-sm font-bold text-on-surface mb-4">Berapa rating Anda? <span class="text-error">*</span></label>
                <div class="flex items-center gap-2" id="starRating">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setRating({{ $i }})"
                            class="star-btn text-4xl transition-all hover:scale-125 focus:outline-none"
                            data-star="{{ $i }}">
                            <span class="material-symbols-outlined text-4xl text-outline/30" style="font-variation-settings: 'FILL' 1;" id="star-{{ $i }}">star</span>
                        </button>
                    @endfor
                    <span id="ratingLabel" class="ml-4 text-sm font-bold text-on-surface-variant"></span>
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating') }}" />
                @error('rating')
                    <p class="text-sm text-error mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Review Text --}}
            <div class="mb-8">
                <label for="keluhan_masukan" class="block text-sm font-bold text-on-surface mb-3">
                    Masukan & Saran <span class="text-error">*</span>
                </label>
                <textarea name="keluhan_masukan" id="keluhan_masukan" rows="6"
                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none"
                    placeholder="Ceritakan pengalaman Anda... Apa yang Anda suka? Ada saran perbaikan? (minimal 10 karakter)"
                >{{ old('keluhan_masukan') }}</textarea>
                <div class="flex justify-between mt-2">
                    @error('keluhan_masukan')
                        <p class="text-sm text-error">{{ $message }}</p>
                    @else
                        <span></span>
                    @enderror
                    <span class="text-xs text-on-surface-variant" id="charCount">0/2000</span>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('pelanggan.ulasan.index') }}" class="px-6 py-3 text-sm font-bold text-on-surface-variant hover:text-on-surface transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold text-sm rounded-full hover:bg-primary-container transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">send</span>
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const ratingLabels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

    function setRating(rating) {
        document.getElementById('ratingInput').value = rating;
        document.getElementById('ratingLabel').textContent = ratingLabels[rating];

        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById('star-' + i);
            if (i <= rating) {
                star.classList.remove('text-outline/30');
                star.classList.add('text-amber-500');
            } else {
                star.classList.remove('text-amber-500');
                star.classList.add('text-outline/30');
            }
        }
    }

    // Initialize
    const initialRating = document.getElementById('ratingInput').value;
    if (initialRating) setRating(parseInt(initialRating));

    // Char counter
    const textarea = document.getElementById('keluhan_masukan');
    const charCount = document.getElementById('charCount');
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length + '/2000';
    });
    charCount.textContent = textarea.value.length + '/2000';
</script>
@endpush
