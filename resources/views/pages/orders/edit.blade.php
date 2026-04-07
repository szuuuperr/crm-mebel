@extends('layouts.app')

@section('title', 'Ubah Pesanan #' . $order->nomor_faktur)

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('sales') }}">Penjualan</a>
        <span class="text-outline-variant">/</span>
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('sales.show', $order->id) }}">#{{ $order->nomor_faktur }}</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Ubah Pesanan</span>
    </nav>

    @if($errors->any())
    <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-lg">
        <p class="font-bold mb-2">Terjadi kesalahan:</p>
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Ubah Pesanan</h2>
                <p class="text-on-surface-variant mt-1">#{{ $order->nomor_faktur }}</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('sales.show', $order->id) }}">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-8 space-y-8">
                <!-- Client -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Detail Pelanggan</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Pelanggan *</label>
                            <select name="customer_id" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                @foreach($customers as $cust)
                                <option value="{{ $cust->id }}" {{ old('customer_id', $order->customer_id) == $cust->id ? 'selected' : '' }}>{{ $cust->nama }} — {{ $cust->telepon }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tanggal Pesanan *</label>
                            <input name="tanggal_pesanan" type="date" value="{{ old('tanggal_pesanan', $order->tanggal_pesanan->format('Y-m-d')) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required/>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">chair</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Item Pesanan</h3>
                    </div>

                    <div id="orderItems">
                        @foreach($order->items as $i => $item)
                        <div class="order-item bg-surface-container-low rounded-lg p-6 mb-4" data-index="{{ $i }}">
                            <div class="flex items-start gap-6">
                                <div class="flex-1 space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Produk *</label>
                                        <select name="items[{{ $i }}][product_id]" class="product-select w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required onchange="recalculate()">
                                            <option value="">Pilih produk...</option>
                                            @foreach($products as $prod)
                                            <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}" {{ $item->product_id == $prod->id ? 'selected' : '' }}>{{ $prod->nama_produk }} — Rp {{ number_format($prod->harga, 0, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-outline uppercase">Jumlah</label>
                                            <input name="items[{{ $i }}][jumlah]" type="number" min="1" value="{{ $item->jumlah }}" class="item-qty w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required oninput="recalculate()"/>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-outline uppercase">Kustomisasi</label>
                                            <input name="items[{{ $i }}][kustomisasi]" type="text" value="{{ $item->kustomisasi }}" class="w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 flex items-center justify-center text-error hover:bg-error/10 rounded-full transition-colors mt-6" {{ $order->items->count() <= 1 ? 'style=display:none' : '' }}>
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="addItem()" class="w-full py-4 border-2 border-dashed border-outline-variant/40 rounded-lg text-primary font-bold text-sm hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">add_circle</span>
                        Tambah Item Lain
                    </button>
                </div>

                <!-- Delivery -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">local_shipping</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Pengiriman & Catatan</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Perkiraan Pengiriman</label>
                                <input name="estimasi_pengiriman" type="date" value="{{ old('estimasi_pengiriman', $order->estimasi_pengiriman?->format('Y-m-d')) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Prioritas</label>
                                <select name="prioritas" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                    <option value="standar" {{ old('prioritas', $order->prioritas) == 'standar' ? 'selected' : '' }}>Standar (6-8 minggu)</option>
                                    <option value="cepat" {{ old('prioritas', $order->prioritas) == 'cepat' ? 'selected' : '' }}>Cepat (3-4 minggu)</option>
                                    <option value="express" {{ old('prioritas', $order->prioritas) == 'express' ? 'selected' : '' }}>Express (1-2 minggu)</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Catatan</label>
                            <textarea name="catatan" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="3">{{ old('catatan', $order->catatan) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Pengiriman</label>
                            <textarea name="alamat_pengiriman" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="2">{{ old('alamat_pengiriman', $order->alamat_pengiriman) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-span-4">
                <div class="sticky top-28 space-y-6">
                    <!-- Summary -->
                    <div class="bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 opacity-10">
                            <span class="material-symbols-outlined text-[100px]">receipt_long</span>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-lg font-bold mb-6">Ringkasan</h4>
                            <div id="summaryItems" class="space-y-2 pb-6 border-b border-on-primary/20"></div>
                            <div class="space-y-3 pt-6 pb-6 border-b border-on-primary/20">
                                <div class="flex justify-between text-sm">
                                    <span class="text-on-primary/70">Subtotal</span>
                                    <span id="summarySubtotal" class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Pajak (%)</label>
                                    <input name="pajak_persen" type="number" step="0.01" value="{{ old('pajak_persen', $order->pajak_persen) }}" class="w-20 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="pajakInput"/>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-on-primary/70">Pajak</span>
                                    <span id="summaryPajak" class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Ongkir</label>
                                    <input name="ongkir" type="number" value="{{ old('ongkir', $order->ongkir) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="ongkirInput"/>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Diskon</label>
                                    <input name="diskon" type="number" value="{{ old('diskon', $order->diskon) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="diskonInput"/>
                                </div>
                            </div>
                            <div class="flex justify-between pt-6">
                                <span class="font-bold text-lg">Total</span>
                                <span id="summaryTotal" class="text-2xl font-black font-headline">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Status & Pembayaran</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Status Pesanan</label>
                                <select name="status" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required>
                                    <option value="prospek" {{ old('status', $order->status) == 'prospek' ? 'selected' : '' }}>Prospek Baru</option>
                                    <option value="dalam_produksi" {{ old('status', $order->status) == 'dalam_produksi' ? 'selected' : '' }}>Dalam Produksi</option>
                                    <option value="dikirim" {{ old('status', $order->status) == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="selesai" {{ old('status', $order->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status', $order->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Status Pembayaran</label>
                                <select name="status_pembayaran" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required>
                                    <option value="belum_bayar" {{ old('status_pembayaran', $order->status_pembayaran) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="dp" {{ old('status_pembayaran', $order->status_pembayaran) == 'dp' ? 'selected' : '' }}>DP Dibayar</option>
                                    <option value="lunas" {{ old('status_pembayaran', $order->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required>
                                    <option value="transfer_bank" {{ old('metode_pembayaran', $order->metode_pembayaran) == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="kartu_kredit" {{ old('metode_pembayaran', $order->metode_pembayaran) == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                                    <option value="dp_pelunasan" {{ old('metode_pembayaran', $order->metode_pembayaran) == 'dp_pelunasan' ? 'selected' : '' }}>DP + Pelunasan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                        <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                        <p class="text-xs text-on-surface-variant mb-4">Hapus pesanan ini secara permanen.</p>
                        <button type="button" onclick="deleteOrder()" class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">delete_forever</span>
                            Hapus Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="deleteOrderForm" action="{{ route('orders.destroy', $order->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script>
    let itemIndex = {{ $order->items->count() }};

    function addItem() {
        const container = document.getElementById('orderItems');
        const html = `
        <div class="order-item bg-surface-container-low rounded-lg p-6 mb-4" data-index="${itemIndex}">
            <div class="flex items-start gap-6">
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Produk *</label>
                        <select name="items[${itemIndex}][product_id]" class="product-select w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required onchange="recalculate()">
                            <option value="">Pilih produk...</option>
                            @foreach($products as $prod)
                            <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}">{{ $prod->nama_produk }} — Rp {{ number_format($prod->harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-outline uppercase">Jumlah</label>
                            <input name="items[${itemIndex}][jumlah]" type="number" min="1" value="1" class="item-qty w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required oninput="recalculate()"/>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-outline uppercase">Kustomisasi</label>
                            <input name="items[${itemIndex}][kustomisasi]" type="text" class="w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm"/>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="removeItem(this)" class="w-10 h-10 flex items-center justify-center text-error hover:bg-error/10 rounded-full transition-colors mt-6">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        itemIndex++;
        updateDeleteButtons();
    }

    function removeItem(btn) { btn.closest('.order-item').remove(); updateDeleteButtons(); recalculate(); }
    function updateDeleteButtons() {
        const items = document.querySelectorAll('.order-item');
        items.forEach(item => {
            const btn = item.querySelector('button[onclick*="removeItem"]');
            if (btn) btn.style.display = items.length > 1 ? 'flex' : 'none';
        });
    }
    function deleteOrder() { if (confirm('Yakin ingin menghapus pesanan ini?')) document.getElementById('deleteOrderForm').submit(); }
    function formatRp(num) { return 'Rp ' + Math.round(num).toLocaleString('id-ID'); }
    function recalculate() {
        let subtotal = 0; let html = '';
        document.querySelectorAll('.order-item').forEach(item => {
            const sel = item.querySelector('.product-select'), qty = item.querySelector('.item-qty');
            if (sel.value && qty.value) {
                const opt = sel.options[sel.selectedIndex], h = parseFloat(opt.dataset.harga)||0, q = parseInt(qty.value)||1, t = h*q;
                subtotal += t; html += `<div class="flex justify-between text-sm"><span class="text-on-primary/70">${opt.text.split(' — ')[0]} × ${q}</span><span class="font-bold">${formatRp(t)}</span></div>`;
            }
        });
        document.getElementById('summaryItems').innerHTML = html || '<p class="text-sm text-on-primary/50 italic">Belum ada item</p>';
        document.getElementById('summarySubtotal').textContent = formatRp(subtotal);
        const pp = parseFloat(document.getElementById('pajakInput').value)||0, pj = subtotal*(pp/100);
        document.getElementById('summaryPajak').textContent = formatRp(pj);
        const ok = parseFloat(document.getElementById('ongkirInput').value)||0, dk = parseFloat(document.getElementById('diskonInput').value)||0;
        document.getElementById('summaryTotal').textContent = formatRp(subtotal + pj + ok - dk);
    }
    // Init events
    document.querySelectorAll('.product-select').forEach(el => el.addEventListener('change', recalculate));
    document.querySelectorAll('.item-qty').forEach(el => el.addEventListener('input', recalculate));
    document.getElementById('pajakInput').addEventListener('input', recalculate);
    document.getElementById('ongkirInput').addEventListener('input', recalculate);
    document.getElementById('diskonInput').addEventListener('input', recalculate);
    recalculate(); // initial calc
</script>
@endpush
@endsection
