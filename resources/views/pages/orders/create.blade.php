@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('sales') }}">Buku Penjualan</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Pesanan Baru</span>
    </nav>

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
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
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
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">search</span>
                            <input class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="Cari pelanggan berdasarkan nama atau email..." type="text"/>
                        </div>
                        <!-- Quick client suggestions -->
                        <div class="mt-3 flex gap-3">
                            @php
                                $quickClients = [
                                    ['name' => 'Eleanor Vance', 'avatar' => 'EV'],
                                    ['name' => 'Marcus Sterling', 'avatar' => 'MS'],
                                    ['name' => 'Sienna Rossi', 'avatar' => 'SR'],
                                ];
                            @endphp
                            @foreach($quickClients as $c)
                            <button class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-full hover:bg-primary/5 transition-colors">
                                <div class="w-7 h-7 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-[10px] font-bold">{{ $c['avatar'] }}</div>
                                <span class="text-xs font-bold text-on-surface">{{ $c['name'] }}</span>
                            </button>
                            @endforeach
                            <a class="flex items-center gap-2 px-4 py-2 border border-primary/20 text-primary rounded-full hover:bg-primary/5 transition-colors" href="{{ route('clients.create') }}">
                                <span class="material-symbols-outlined text-sm">add</span>
                                <span class="text-xs font-bold">Pelanggan Baru</span>
                            </a>
                        </div>
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

                <!-- Order Item Row -->
                <div class="bg-surface-container-low rounded-lg p-6 mb-4">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 rounded-lg bg-surface-container-high overflow-hidden flex-shrink-0">
                            <img alt="Product" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwAGdklILBnFVyYeR_3qC32xslA_Lbv6ASn3bx3mE64hQdAAYIqm6q0LlW3tLNTfCi_VlTmfdNr4wJzRyTwSAJe4zpkeXL-bfOGZb09jvV6o2uyY7irxUcaIVAkf_wfp7znxhrO2e1p1tqf262lVSpMxkD-VFWVEWBNm5j2TCCEoNiLELhJw75Hhn0JIhombuhCCrUHnncMJ_xVD38P8JFZSiB9q6V5k6JTNtXGkvK3k33TJmvy3Y6Ttb--lOQRbnM5Ot27EZHi62A"/>
                        </div>
                        <div class="flex-1">
                            <select class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm mb-2">
                                <option>Custom Walnut Dining Table — $4,200</option>
                                <option>The Sculptural Armchair — $1,240</option>
                                <option>Heritage Oak Table — $3,800</option>
                                <option>Linear Teak Sideboard — $2,150</option>
                                <option>Royal Mahogany Cabinet — $5,400</option>
                            </select>
                            <div class="flex gap-4 items-center">
                                <div>
                                    <label class="text-[10px] font-bold text-outline uppercase">Jml</label>
                                    <input class="w-20 px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" type="number" value="1"/>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-outline uppercase">Kustomisasi</label>
                                    <input class="w-full px-3 py-2 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" placeholder="cth., Finishing Minyak Alami" type="text"/>
                                </div>
                            </div>
                        </div>
                        <button class="w-10 h-10 flex items-center justify-center text-error hover:bg-error/10 rounded-full transition-colors">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </div>

                <button class="w-full py-4 border-2 border-dashed border-outline-variant/40 rounded-lg text-primary font-bold text-sm hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
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
                            <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tingkat Prioritas</label>
                            <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option>Standar (6-8 minggu)</option>
                                <option>Cepat (3-4 minggu)</option>
                                <option>Express (1-2 minggu)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Instruksi Khusus</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Permintaan kustom, catatan pengiriman, atau kebutuhan khusus..." rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Pengiriman</label>
                        <textarea class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Alamat pengiriman lengkap..." rows="2"></textarea>
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
                        <div class="space-y-4 pb-6 border-b border-on-primary/20">
                            <div class="flex justify-between text-sm">
                                <span class="text-on-primary/70">Custom Walnut Dining Table × 1</span>
                                <span class="font-bold">$4,200.00</span>
                            </div>
                        </div>
                        <div class="space-y-3 pt-6 pb-6 border-b border-on-primary/20">
                            <div class="flex justify-between text-sm">
                                <span class="text-on-primary/70">Subtotal</span>
                                <span class="font-medium">$4,200.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-on-primary/70">Tax (8%)</span>
                                <span class="font-medium">$336.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-on-primary/70">Pengiriman</span>
                                <span class="font-medium">$150.00</span>
                            </div>
                        </div>
                        <div class="flex justify-between pt-6">
                            <span class="font-bold text-lg">Total</span>
                            <span class="text-2xl font-black font-headline">$4,686.00</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Metode Pembayaran</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input checked class="text-primary focus:ring-primary" name="payment" type="radio"/>
                            <span class="material-symbols-outlined text-primary text-sm">account_balance</span>
                            <span class="text-sm font-medium">Transfer Bank</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="payment" type="radio"/>
                            <span class="material-symbols-outlined text-primary text-sm">credit_card</span>
                            <span class="text-sm font-medium">Kartu Kredit</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="text-primary focus:ring-primary" name="payment" type="radio"/>
                            <span class="material-symbols-outlined text-primary text-sm">schedule</span>
                            <span class="text-sm font-medium">DP 50% + Pelunasan Saat Pengiriman</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
