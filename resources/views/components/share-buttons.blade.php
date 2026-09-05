@props(['reviewable'])

@php
    $shareUrl = $reviewable->review_url;
    $whatsappUrl = $reviewable->review_whatsapp_url;
    $emailUrl = $reviewable->review_email_url;
@endphp

<div class="space-y-4">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-lg">share</span>
        <h3 class="text-lg font-bold text-primary">Bagikan Permintaan Ulasan</h3>
    </div>

    <p class="text-xs text-on-surface-variant leading-relaxed mb-4">
        Bagikan link permintaan ulasan ke pelanggan melalui WhatsApp, email, atau salin tautan.
    </p>

    {{-- URL display + copy --}}
    <div class="flex items-center gap-2 bg-surface-container rounded-xl p-2">
        <span class="material-symbols-outlined text-outline text-[18px] pl-2">link</span>
        <input type="text" readonly value="{{ $shareUrl }}"
            class="flex-1 bg-transparent text-xs text-on-surface-variant font-medium border-none focus:outline-none focus:ring-0 min-w-0"
            id="reviewShareUrl" onclick="this.select()" />
        <button type="button" onclick="copyReviewLink()"
            class="flex items-center gap-1.5 px-3 py-1.5 bg-primary text-on-primary text-xs font-bold rounded-full hover:bg-primary-container hover:text-on-primary-container transition-colors whitespace-nowrap">
            <span class="material-symbols-outlined text-[14px]" id="copyIcon">content_copy</span>
            <span id="copyLabel">Salin</span>
        </button>
    </div>

    {{-- Action buttons --}}
    <div class="grid grid-cols-2 gap-3">
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
            class="flex items-center justify-center gap-2 px-4 py-3 bg-[#25D366]/10 hover:bg-[#25D366]/20 text-[#128C7E] font-bold text-sm rounded-full transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            WhatsApp
        </a>

        <a href="{{ $emailUrl }}" target="_blank" rel="noopener"
            class="flex items-center justify-center gap-2 px-4 py-3 bg-primary/5 hover:bg-primary/10 text-primary font-bold text-sm rounded-full transition-colors">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            Email
        </a>
    </div>

    <p class="text-[10px] text-outline leading-relaxed">
        Link permintaan ulasan hanya tersedia selama pesanan/proyek berstatus
        <span class="font-bold text-emerald-600">Selesai</span>.
    </p>
</div>

@push('scripts')
    <script>
        function copyReviewLink() {
            const url = document.getElementById('reviewShareUrl');
            navigator.clipboard.writeText(url.value).then(() => {
                document.getElementById('copyLabel').textContent = 'Tersalin!';
                document.getElementById('copyIcon').textContent = 'check';
                setTimeout(() => {
                    document.getElementById('copyLabel').textContent = 'Salin';
                    document.getElementById('copyIcon').textContent = 'content_copy';
                }, 2000);
            });
        }
    </script>
@endpush