@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->nomor_faktur)

@section('content')
    <div class="pt-28 px-10 pb-20">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm mb-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-medium"
                href="{{ route('sales') }}">Penjualan</a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary font-bold">#{{ $order->nomor_faktur }}</span>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-400 text-white rounded-lg font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Order Header -->
        <div class="bg-primary rounded-xl p-10 mb-10 relative overflow-hidden">
            <div class="absolute -right-16 -bottom-16 opacity-10">
                <span class="material-symbols-outlined text-[200px]">receipt_long</span>
            </div>
            <div class="relative z-10 flex justify-between items-start">
                <div class="text-on-primary">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-3xl font-black font-headline">#{{ $order->nomor_faktur }}</span>
                        @php
                            $statusBadge = match ($order->status) {
                                'prospek' => 'bg-stone-400/20 text-stone-200',
                                'dalam_produksi' => 'bg-amber-400/20 text-amber-200',
                                'dikirim' => 'bg-blue-400/20 text-blue-200',
                                'selesai' => 'bg-emerald-400/20 text-emerald-200',
                                'dibatalkan' => 'bg-red-400/20 text-red-200',
                                default => 'bg-stone-400/20 text-stone-200',
                            };
                        @endphp
                        <span
                            class="px-3 py-1 {{ $statusBadge }} text-xs font-bold uppercase tracking-wider rounded-full">{{ $order->status_label }}</span>
                    </div>
                    <p class="text-on-primary/70 font-medium">
                        Dipesan {{ $order->tanggal_pesanan->translatedFormat('d M Y') }}
                        @if($order->estimasi_pengiriman)
                            · Perkiraan Pengiriman {{ $order->estimasi_pengiriman->translatedFormat('d M Y') }}
                        @endif
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('orders.edit', $order->id) }}"
                        class="px-6 py-3 bg-white/10 hover:bg-white/20 text-on-primary font-bold rounded-full transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Ubah Pesanan
                    </a>
                    <button type="button"
                        onclick="if(confirm('Yakin ingin menghapus pesanan ini?')) document.getElementById('deleteForm').submit()"
                        class="px-6 py-3 bg-white text-primary font-bold rounded-full hover:scale-[1.02] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">delete</span>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        <form id="deleteForm" action="{{ route('orders.destroy', $order->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <div class="grid grid-cols-12 gap-10">
            <!-- Main Content -->
            <div class="col-span-8 space-y-8">
                <!-- Order Items -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-primary mb-6">Item Pesanan</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-6 p-5 bg-surface-container-low rounded-xl">
                                <div class="w-24 h-24 rounded-lg overflow-hidden flex-shrink-0 bg-surface-container-high">
                                    @if($item->product && $item->product->cover_url)
                                        <img alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover"
                                            src="{{ $item->product->cover_url }}" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-outline/30">chair</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-on-surface">
                                        {{ $item->product->nama_produk ?? 'Produk Dihapus' }}</h4>
                                    @if($item->kustomisasi)
                                        <p class="text-sm text-on-surface-variant">{{ $item->kustomisasi }}</p>
                                    @endif
                                    <div class="flex items-center gap-3 mt-2">
                                        @if($item->product && $item->product->jenisKayu)
                                            <span
                                                class="text-[10px] bg-primary/10 text-primary px-2 py-0.5 rounded-full font-bold uppercase">{{ $item->product->jenisKayu->nama }}</span>
                                        @endif
                                        @if($item->product && $item->product->kategori)
                                            <span
                                                class="text-[10px] bg-surface-container-high text-on-surface-variant px-2 py-0.5 rounded-full font-bold">{{ $item->product->kategori->nama }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-outline uppercase font-bold tracking-widest">Jml: {{ $item->jumlah }}
                                    </p>
                                    <p class="text-2xl font-black text-primary font-headline mt-1">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Totals -->
                    <div class="mt-6 pt-6 border-t border-outline-variant/20 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Subtotal</span>
                            <span class="font-medium text-on-surface">Rp
                                {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($order->pajak > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-on-surface-variant">Pajak ({{ $order->pajak_persen }}%)</span>
                                <span class="font-medium text-on-surface">Rp
                                    {{ number_format($order->pajak, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        @if($order->ongkir > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-on-surface-variant">Pengiriman</span>
                                <span class="font-medium text-on-surface">Rp
                                    {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        @if($order->diskon > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-on-surface-variant">Diskon</span>
                                <span class="font-medium text-error">-Rp {{ number_format($order->diskon, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between pt-3 border-t border-outline-variant/20">
                            <span class="text-lg font-bold text-on-surface">Total</span>
                            <span class="text-2xl font-black text-primary font-headline">{{ $order->total_format }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Status Timeline -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-primary mb-6">Status Pesanan</h3>
                    <div class="flex items-center gap-0 mb-8">
                        @php
                            $allStages = ['prospek', 'dalam_produksi', 'dikirim', 'selesai'];
                            $stageLabels = [
                                'prospek' => 'Dikonfirmasi',
                                'dalam_produksi' => 'Dalam Produksi',
                                'dikirim' => 'Dikirim',
                                'selesai' => 'Diterima',
                            ];
                            $currentIdx = array_search($order->status, $allStages);
                            if ($currentIdx === false)
                                $currentIdx = -1;
                        @endphp
                        @foreach($allStages as $i => $stage)
                            <div class="flex items-center {{ $i < count($allStages) - 1 ? 'flex-1' : '' }}">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold {{ $i <= $currentIdx ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-outline' }}">
                                        @if($i <= $currentIdx)
                                            <span class="material-symbols-outlined text-sm">check</span>
                                        @else
                                            {{ $i + 1 }}
                                        @endif
                                    </div>
                                    <span
                                        class="text-[10px] font-bold mt-2 {{ $i <= $currentIdx ? 'text-primary' : 'text-outline' }} whitespace-nowrap">{{ $stageLabels[$stage] }}</span>
                                </div>
                                @if($i < count($allStages) - 1)
                                    <div
                                        class="flex-1 h-1 mx-2 rounded-full {{ $i < $currentIdx ? 'bg-primary' : 'bg-outline-variant/20' }}">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if($order->status === 'dibatalkan')
                        <div class="p-4 bg-error/10 rounded-lg">
                            <p class="text-sm font-bold text-error flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">cancel</span>
                                Pesanan ini telah dibatalkan
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Feedback -->
                @if($order->status === 'selesai' && !$order->rating && !$order->keluhan_masukan)
                <div class="bg-primary/5 rounded-xl p-8 border border-primary/20">
                    <h3 class="text-xl font-bold text-primary mb-2">Beri Penilaian Transaksi</h3>
                    <p class="text-sm text-on-surface-variant mb-6">Bagaimana layanan penjualan / produk kami? Keluhan dan masukan Anda sangat berarti.</p>
                    <form action="{{ route('sales.feedback', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Rating</label>
                            <select name="rating" required class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm">
                                <option value="">Pilih Rating...</option>
                                <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                <option value="4">⭐⭐⭐⭐ (Puas)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Kurang)</option>
                                <option value="1">⭐ (Sangat Kurang)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Keluhan / Masukan</label>
                            <textarea name="keluhan_masukan" rows="3" required class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" placeholder="Tuliskan pengalaman atau kendala yang dialami..."></textarea>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-full hover:scale-[1.02] transition-all">Simpan Penilaian</button>
                    </form>
                </div>
                @elseif($order->rating || $order->keluhan_masukan)
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-primary mb-4">Penilaian Transaksi</h3>
                    @if($order->rating)
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl font-bold text-on-surface">{{ $order->rating }} / 5</span>
                        <span class="text-amber-400 text-xl">{{ str_repeat('★', $order->rating) }}{{ str_repeat('☆', 5 - $order->rating) }}</span>
                    </div>
                    @endif
                    @if($order->keluhan_masukan)
                    <div>
                        <p class="text-xs font-bold text-outline uppercase tracking-widest mb-1">Masukan</p>
                        <p class="text-on-surface-variant italic">"{{ $order->keluhan_masukan }}"</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-span-4">
                <div class="sticky top-28 space-y-6">
                    <!-- Client Info -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pelanggan</h4>
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-14 h-14 rounded-xl bg-primary-container flex items-center justify-center text-lg font-bold text-on-primary-container">
                                OP
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">Nama Pelanggan</p>
                                <p class="text-xs text-on-surface-variant">Email Pelanggan</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            @if($order->customer->telepon)
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="material-symbols-outlined text-primary text-[18px]">call</span>
                                    <span class="text-on-surface font-medium">Nomor telepon</span>
                                </div>
                            @endif
                            @if($order->customer->kota)
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                                    <span
                                        class="text-on-surface font-medium">{{ $order->customer->kota }}{{ $order->customer->provinsi ? ', ' . $order->customer->provinsi : '' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pembayaran</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-xs text-on-surface-variant">Metode</span>
                                <span class="text-sm font-bold text-on-surface">
                                    @php
                                        $metodeLbl = match ($order->metode_pembayaran) {
                                            'transfer_bank' => 'Transfer Bank',
                                            'kartu_kredit' => 'Kartu Kredit',
                                            'dp_pelunasan' => 'DP + Pelunasan',
                                            default => '-',
                                        };
                                    @endphp
                                    {{ $metodeLbl }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-on-surface-variant">Status</span>
                                @php
                                    $bayarLbl = match ($order->status_pembayaran) {
                                        'belum_bayar' => ['Belum Bayar', 'text-error'],
                                        'dp' => ['DP Dibayar', 'text-amber-600'],
                                        'lunas' => ['Lunas', 'text-emerald-600'],
                                        default => ['-', 'text-on-surface'],
                                    };
                                @endphp
                                <span class="text-sm font-bold {{ $bayarLbl[1] }}">{{ $bayarLbl[0] }}</span>
                            </div>
                            @php
                                $totalBayar = $order->payments->sum('jumlah');
                                $sisaBayar = $order->total - $totalBayar;
                                $pctBayar = $order->total > 0 ? round(($totalBayar / $order->total) * 100) : 0;
                            @endphp
                            <div class="flex justify-between">
                                <span class="text-xs text-on-surface-variant">Dibayar</span>
                                <span class="text-sm font-bold text-primary">Rp
                                    {{ number_format($totalBayar, 0, ',', '.') }} ({{ $pctBayar }}%)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-on-surface-variant">Sisa</span>
                                <span class="text-sm font-bold {{ $sisaBayar > 0 ? 'text-error' : 'text-emerald-600' }}">Rp
                                    {{ number_format(max($sisaBayar, 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: {{ $pctBayar }}%"></div>
                            </div>
                            <p class="text-[10px] text-outline text-center">{{ $pctBayar }}% dibayar</p>
                        </div>
                    </div>

                    <!-- Delivery Info -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-xs font-bold text-outline uppercase tracking-widest mb-4">Pengiriman</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-xs text-on-surface-variant">Prioritas</span>
                                <span class="text-sm font-bold text-on-surface">{{ ucfirst($order->prioritas) }}</span>
                            </div>
                            @if($order->estimasi_pengiriman)
                                <div class="flex justify-between">
                                    <span class="text-xs text-on-surface-variant">Estimasi</span>
                                    <span
                                        class="text-sm font-bold text-on-surface">{{ $order->estimasi_pengiriman->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                            @if($order->alamat_pengiriman)
                                <div class="flex justify-between">
                                    <span class="text-xs text-on-surface-variant">Alamat</span>
                                    <span
                                        class="text-sm font-bold text-on-surface text-right max-w-[160px]">{{ $order->alamat_pengiriman }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($order->catatan)
                        <div class="bg-secondary-container/30 rounded-xl p-6 border border-secondary-container/50">
                            <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">note</span>
                                Instruksi Khusus
                            </h4>
                            <p class="text-xs text-on-surface-variant leading-relaxed">{{ $order->catatan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection