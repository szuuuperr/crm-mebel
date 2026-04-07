@extends('layouts.app')

@section('title', 'Proyek Baru')

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('dashboard') }}">Proyek</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Proyek Baru</span>
    </nav>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Buat Proyek Baru</h2>
                <p class="text-on-surface-variant mt-1">Mulai komisi pertukangan kayu kustom baru</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" href="{{ route('projects.index') }}">Batal</a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">rocket_launch</span>
                    Mulai Proyek
                </button>
            </div>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-400 text-white rounded-lg font-medium shadow-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-12 gap-10">
            <div class="col-span-8 space-y-8">
            <!-- Project Details -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">assignment</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Detail Proyek</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Proyek *</label>
                        <input name="nama" value="{{ old('nama') }}" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Set Meja Makan Walnut Kustom — Rumah Anderson" type="text"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jenis Proyek *</label>
                            <select name="jenis" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih jenis...</option>
                                <option value="komisi_kustom" {{ old('jenis') == 'komisi_kustom' ? 'selected' : '' }}>Komisi Kustom</option>
                                <option value="produksi_stok" {{ old('jenis') == 'produksi_stok' ? 'selected' : '' }}>Produksi Stok</option>
                                <option value="restorasi" {{ old('jenis') == 'restorasi' ? 'selected' : '' }}>Restorasi</option>
                                <option value="renovasi" {{ old('jenis') == 'renovasi' ? 'selected' : '' }}>Renovasi Ruangan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Pelanggan *</label>
                            <select name="customer_id" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih pelanggan...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }} ({{ $customer->perusahaan ?? 'Personal' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tanggal Mulai</label>
                            <input name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Target Selesai</label>
                            <input name="target_selesai" value="{{ old('target_selesai') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi Proyek</label>
                        <textarea name="deskripsi" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Jelaskan cakupan proyek, visi pelanggan, dan kebutuhan khusus..." rows="4">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Material & Specs -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">carpenter</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Material & Spesifikasi</h3>
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Jenis Kayu Utama</label>
                        <select name="jenis_kayu_id" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                            <option value="">Pilih Jenis Kayu...</option>
                            @foreach($jenisKayus as $kayu)
                            <option value="{{ $kayu->id }}" {{ old('jenis_kayu_id') == $kayu->id ? 'selected' : '' }}>{{ $kayu->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Tipe Finishing</label>
                        <input name="finishing" value="{{ old('finishing') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Natural Wax, Satin Varnish, PU Clear" type="text"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Dimensi Produk (cm)</label>
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Panjang</label>
                                <input name="panjang" type="number" step="0.1" value="{{ old('panjang') }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Lebar</label>
                                <input name="lebar" type="number" step="0.1" value="{{ old('lebar') }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Tinggi</label>
                                <input name="tinggi" type="number" step="0.1" value="{{ old('tinggi') }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Estimasi Berat (kg)</label>
                        <input name="berat" type="number" step="0.1" value="{{ old('berat') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kebutuhan Khusus / Kustomisasi Ekstra</label>
                        <textarea name="kebutuhan_khusus" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="cth., Live edge, engsel khusus, ukiran manual..." rows="3">{{ old('kebutuhan_khusus') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Milestones -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">flag</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary font-headline">Tahapan Proyek</h3>
                </div>
                <div id="milestones-container" class="space-y-4">
                    @php
                        $defaultMilestones = [
                            ['name' => 'Persetujuan Desain', 'icon' => 'draw'],
                            ['name' => 'Pengadaan Material', 'icon' => 'inventory'],
                            ['name' => 'Perakitan & Konstruksi', 'icon' => 'construction'],
                            ['name' => 'Pengamplasan & Finishing', 'icon' => 'auto_fix_high'],
                            ['name' => 'Inspeksi Kualitas', 'icon' => 'verified'],
                            ['name' => 'Pengiriman & Instalasi', 'icon' => 'local_shipping'],
                        ];
                    @endphp
                    @foreach($defaultMilestones as $index => $ms)
                    <div class="milestone-item flex items-center gap-4 p-4 bg-surface-container-low rounded-lg">
                        <span class="material-symbols-outlined text-primary">
                            <input type="hidden" name="milestones[{{ $index }}][icon]" value="{{ $ms['icon'] }}">
                            {{ $ms['icon'] }}
                        </span>
                        <input type="text" name="milestones[{{ $index }}][nama]" value="{{ $ms['name'] }}" class="text-sm font-bold bg-transparent border-none focus:ring-0 text-on-surface flex-1 px-0" placeholder="Nama Tahapan" required>
                        <select name="milestones[{{ $index }}][status]" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium">
                            <option value="pending">Pending</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <input type="date" name="milestones[{{ $index }}][tanggal_target]" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium w-36" placeholder="Perkiraan tanggal"/>
                        <button type="button" onclick="this.closest('.milestone-item').remove()" class="text-outline hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" onclick="addMilestone()" class="mt-4 w-full py-3 border-2 border-dashed border-outline-variant/40 rounded-lg text-primary font-bold text-sm hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tambah Tahapan Kustom
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
                            <select name="prioritas_pengiriman" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                <option value="standar" {{ old('prioritas_pengiriman') == 'standar' ? 'selected' : '' }}>Standar (6-8 minggu)</option>
                                <option value="cepat" {{ old('prioritas_pengiriman') == 'cepat' ? 'selected' : '' }}>Cepat (3-4 minggu)</option>
                                <option value="express" {{ old('prioritas_pengiriman') == 'express' ? 'selected' : '' }}>Express (1-2 minggu)</option>
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

        <!-- Sidebar -->
        <div class="col-span-4">
            <div class="sticky top-28 space-y-6">
                <!-- Ringkasan Proyek -->
                <div class="bg-primary text-on-primary rounded-xl p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <span class="material-symbols-outlined text-[100px]">receipt_long</span>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-lg font-bold mb-6">Ringkasan Proyek</h4>
                        <div class="space-y-3 pt-6 pb-6 border-b border-on-primary/20">
                            <div class="flex justify-between text-sm items-center">
                                <label class="text-on-primary/70">Perkiraan Anggaran (Rp)</label>
                                <input name="anggaran" type="number" value="{{ old('anggaran', 0) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="anggaranInput"/>
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

                <!-- Assign Team -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tugaskan Pengrajin</h4>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input checked class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <img alt="Julian" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYZDSDOiwRhwyGRYIJa7mN0i0g8bMKdMesH2MCjvR7uoG2m0eylA2zJ52G6c8Mdj7wpdPXQRLEB_tIXCf-NZW85oYym2hAI2kUzXCZGSIsD1P-vIeRUg8rH5OikpzVjATgA4kMQmck8s5fPaSBZ-3Tgw4kRuR33NsG1iV0HYbFu0I15eY1TTDxOXebh6Y6qpL9xhvsUYeN_mbph7_pUC-N-IPOYcxwegXy3G-_7LO06mijAu1Pqa_N2KTvVRT3reejJwvFLBeRDeP3"/>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Julian Thorne</p>
                                <p class="text-[10px] text-on-surface-variant">Tukang Kayu Utama</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-[10px] font-bold">MR</div>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Marco Rivera</p>
                                <p class="text-[10px] text-on-surface-variant">Spesialis Finishing</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input class="rounded text-primary focus:ring-primary" type="checkbox"/>
                            <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-[10px] font-bold">AK</div>
                            <div>
                                <p class="text-xs font-bold text-on-surface">Aisha Khan</p>
                                <p class="text-[10px] text-on-surface-variant">Konsultan Desain</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Priority -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Tingkat Prioritas</h4>
                    <select name="prioritas" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                        <option value="standar" {{ old('prioritas') == 'standar' ? 'selected' : '' }}>Standar</option>
                        <option value="tinggi" {{ old('prioritas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="mendesak" {{ old('prioritas') == 'mendesak' ? 'selected' : '' }}>Mendesak</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@push('scripts')
<script>
    let milestoneIndex = 100;
    function addMilestone() {
        const container = document.getElementById('milestones-container');
        const html = `
            <div class="milestone-item flex items-center gap-4 p-4 bg-surface-container-low rounded-lg">
                <span class="material-symbols-outlined text-primary">flag</span>
                <input type="hidden" name="milestones[${milestoneIndex}][icon]" value="flag">
                <input type="text" name="milestones[${milestoneIndex}][nama]" class="text-sm font-bold bg-transparent border-none focus:ring-0 text-on-surface flex-1 px-0" placeholder="Nama Tahapan" required>
                <select name="milestones[${milestoneIndex}][status]" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium">
                    <option value="pending">Pending</option>
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                </select>
                <input type="date" name="milestones[${milestoneIndex}][tanggal_target]" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium w-36" placeholder="Perkiraan tanggal"/>
                <button type="button" onclick="this.closest('.milestone-item').remove()" class="text-outline hover:text-error transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        milestoneIndex++;
    }

    function formatRp(num) {
        return 'Rp ' + Math.round(num).toLocaleString('id-ID');
    }

    function recalculate() {
        const anggaran = parseFloat(document.getElementById('anggaranInput').value) || 0;
        const pajakPersen = parseFloat(document.getElementById('pajakInput').value) || 0;
        const pajak = anggaran * (pajakPersen / 100);
        document.getElementById('summaryPajak').textContent = formatRp(pajak);

        const ongkir = parseFloat(document.getElementById('ongkirInput').value) || 0;
        const diskon = parseFloat(document.getElementById('diskonInput').value) || 0;
        const total = anggaran + pajak + ongkir - diskon;
        document.getElementById('summaryTotal').textContent = formatRp(total);
    }

    document.getElementById('anggaranInput').addEventListener('input', recalculate);
    document.getElementById('pajakInput').addEventListener('input', recalculate);
    document.getElementById('ongkirInput').addEventListener('input', recalculate);
    document.getElementById('diskonInput').addEventListener('input', recalculate);

    // Initial run
    recalculate();
</script>
@endpush
@endsection
