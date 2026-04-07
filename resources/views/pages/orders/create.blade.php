@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('sales') }}">Penjualan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Pesanan Baru</span>
    </nav>

    {{-- Flash / Error --}}
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

    <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
        @csrf

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Buat Pesanan Baru</h2>
                <p class="text-on-surface-variant mt-1">Daftarkan pesanan furniture kustom atau stok baru</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('sales') }}">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Buat Pesanan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-10">
            <!-- Form -->
            <div class="col-span-8 space-y-8">
                <!-- Client Selection -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Detail Pelanggan</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Pilih Pelanggan *</label>
                            <select name="customer_id" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                <option value="">Pilih pelanggan...</option>
                                @foreach($customers as $cust)
                                <option value="{{ $cust->id }}" {{ old('customer_id') == $cust->id ? 'selected' : '' }}>{{ $cust->nama }} — {{ $cust->telepon }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tanggal Pesanan *</label>
                            <input name="tanggal_pesanan" type="date" value="{{ old('tanggal_pesanan', date('Y-m-d')) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required/>
                        </div>
                    </div>
                </div>

                <!-- Product Selection -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">chair</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Item Pesanan</h3>
                    </div>

                    <div id="orderItems">
                        <!-- Item row template (first item) -->
                        <div class="order-item bg-surface-container-low rounded-lg p-6 mb-4" data-index="0">
                            <div class="flex items-start gap-6">
                                <div class="flex-1 space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Produk *</label>
                                        <select name="items[0][product_id]" class="product-select w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required>
                                            <option value="">Pilih produk...</option>
                                            @foreach($products as $prod)
                                            <option value="{{ $prod->id }}" data-harga="{{ $prod->harga }}">{{ $prod->nama_produk }} — Rp {{ number_format($prod->harga, 0, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-outline uppercase">Jumlah</label>
                                            <input name="items[0][jumlah]" type="number" min="1" value="1" class="item-qty w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" required/>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-outline uppercase">Kustomisasi</label>
                                            <input name="items[0][kustomisasi]" type="text" placeholder="cth., Finishing Minyak Alami" class="w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 flex items-center justify-center text-error hover:bg-error/10 rounded-full transition-colors mt-6" style="display:none;">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addItem()" class="w-full py-4 border-2 border-dashed border-outline-variant/40 rounded-lg text-primary font-bold text-sm hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">add_circle</span>
                        Tambah Item Lain
                    </button>
                </div>

                <!-- Delivery & Notes -->
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
                                <input name="estimasi_pengiriman" type="date" value="{{ old('estimasi_pengiriman') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tingkat Prioritas</label>
                                <select name="prioritas" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                    <option value="standar" {{ old('prioritas') == 'standar' ? 'selected' : '' }}>Standar (6-8 minggu)</option>
                                    <option value="cepat" {{ old('prioritas') == 'cepat' ? 'selected' : '' }}>Cepat (3-4 minggu)</option>
                                    <option value="express" {{ old('prioritas') == 'express' ? 'selected' : '' }}>Express (1-2 minggu)</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Instruksi Khusus</label>
                            <textarea name="catatan" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Permintaan kustom, catatan pengiriman, atau kebutuhan khusus..." rows="3">{{ old('catatan') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Pengiriman</label>
                            <textarea name="alamat_pengiriman" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Alamat pengiriman lengkap..." rows="2">{{ old('alamat_pengiriman') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-span-4">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden">
                        <div class="absolute -right-8 -bottom-8 opacity-10">
                            <span class="material-symbols-outlined text-[100px]">receipt_long</span>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-lg font-bold mb-6">Ringkasan Pesanan</h4>
                            <div id="summaryItems" class="space-y-2 pb-6 border-b border-on-primary/20">
                                <p class="text-sm text-on-primary/50 italic">Belum ada item</p>
                            </div>
                            <div class="space-y-3 pt-6 pb-6 border-b border-on-primary/20">
                                <div class="flex justify-between text-sm">
                                    <span class="text-on-primary/70">Subtotal</span>
                                    <span id="summarySubtotal" class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Pajak (%)</label>
                                    <input name="pajak_persen" type="number" step="0.01" value="{{ old('pajak_persen', 0) }}" class="w-20 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="pajakInput"/>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-on-primary/70">Pajak</span>
                                    <span id="summaryPajak" class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Ongkir (Rp)</label>
                                    <input name="ongkir" type="number" value="{{ old('ongkir', 0) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="ongkirInput"/>
                                </div>
                                <div class="flex justify-between text-sm items-center">
                                    <label class="text-on-primary/70">Diskon (Rp)</label>
                                    <input name="diskon" type="number" value="{{ old('diskon', 0) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="diskonInput"/>
                                </div>
                            </div>
                            <div class="flex justify-between pt-6">
                                <span class="font-bold text-lg">Total</span>
                                <span id="summaryTotal" class="text-2xl font-black font-headline">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Metode Pembayaran</h4>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                                <input checked name="metode_pembayaran" value="transfer_bank" type="radio" class="text-primary focus:ring-primary"/>
                                <span class="material-symbols-outlined text-primary text-sm">account_balance</span>
                                <span class="text-sm font-medium">Transfer Bank</span>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                                <input name="metode_pembayaran" value="kartu_kredit" type="radio" class="text-primary focus:ring-primary"/>
                                <span class="material-symbols-outlined text-primary text-sm">credit_card</span>
                                <span class="text-sm font-medium">Kartu Kredit</span>
                            </label>
                            <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                                <input name="metode_pembayaran" value="dp_pelunasan" type="radio" class="text-primary focus:ring-primary"/>
                                <span class="material-symbols-outlined text-primary text-sm">schedule</span>
                                <span class="text-sm font-medium">DP 50% + Pelunasan Saat Pengiriman</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let itemIndex = 1;
    const productsData = @json($products->map(fn($p) => ['id' => $p->id, 'nama' => $p->nama_produk, 'harga' => (float)$p->harga]));

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
                            <input name="items[${itemIndex}][kustomisasi]" type="text" placeholder="cth., Finishing Minyak Alami" class="w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm"/>
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

    function removeItem(btn) {
        btn.closest('.order-item').remove();
        updateDeleteButtons();
        recalculate();
    }

    function updateDeleteButtons() {
        const items = document.querySelectorAll('.order-item');
        items.forEach((item, i) => {
            const btn = item.querySelector('button[onclick*="removeItem"]');
            if (btn) btn.style.display = items.length > 1 ? 'flex' : 'none';
        });
    }

    function formatRp(num) {
        return 'Rp ' + Math.round(num).toLocaleString('id-ID');
    }

    function recalculate() {
        let subtotal = 0;
        let summaryHtml = '';
        const items = document.querySelectorAll('.order-item');

        items.forEach(item => {
            const select = item.querySelector('.product-select');
            const qtyInput = item.querySelector('.item-qty');
            if (select.value && qtyInput.value) {
                const option = select.options[select.selectedIndex];
                const harga = parseFloat(option.dataset.harga) || 0;
                const qty = parseInt(qtyInput.value) || 1;
                const lineTotal = harga * qty;
                subtotal += lineTotal;
                const name = option.text.split(' — ')[0];
                summaryHtml += `<div class="flex justify-between text-sm"><span class="text-on-primary/70">${name} × ${qty}</span><span class="font-bold">${formatRp(lineTotal)}</span></div>`;
            }
        });

        document.getElementById('summaryItems').innerHTML = summaryHtml || '<p class="text-sm text-on-primary/50 italic">Belum ada item</p>';
        document.getElementById('summarySubtotal').textContent = formatRp(subtotal);

        const pajakPersen = parseFloat(document.getElementById('pajakInput').value) || 0;
        const pajak = subtotal * (pajakPersen / 100);
        document.getElementById('summaryPajak').textContent = formatRp(pajak);

        const ongkir = parseFloat(document.getElementById('ongkirInput').value) || 0;
        const diskon = parseFloat(document.getElementById('diskonInput').value) || 0;
        const total = subtotal + pajak + ongkir - diskon;
        document.getElementById('summaryTotal').textContent = formatRp(total);
    }

    // Attach events to first item
    document.querySelector('.product-select').addEventListener('change', recalculate);
    document.querySelector('.item-qty').addEventListener('input', recalculate);
    document.getElementById('pajakInput').addEventListener('input', recalculate);
    document.getElementById('ongkirInput').addEventListener('input', recalculate);
    document.getElementById('diskonInput').addEventListener('input', recalculate);
</script>
@endpush
@endsection
