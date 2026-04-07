@extends('layouts.app')

@section('title', 'Edit ' . $project->nama)

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('projects.index') }}">Proyek</a>
        <span class="text-outline-variant">/</span>
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('projects.index') }}">{{ $project->nama }}</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Edit Proyek</span>
    </nav>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT')
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Edit Proyek</h2>
                <p class="text-on-surface-variant mt-1">Perbarui detail proyek "{{ $project->nama }}"</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" href="{{ route('projects.index') }}">Batal</a>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Simpan Perubahan
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
                        <input name="nama" value="{{ old('nama', $project->nama) }}" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Set Meja Makan Walnut Kustom" type="text"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jenis Proyek *</label>
                            <select name="jenis" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih jenis...</option>
                                <option value="komisi_kustom" {{ old('jenis', $project->jenis) == 'komisi_kustom' ? 'selected' : '' }}>Komisi Kustom</option>
                                <option value="produksi_stok" {{ old('jenis', $project->jenis) == 'produksi_stok' ? 'selected' : '' }}>Produksi Stok</option>
                                <option value="restorasi" {{ old('jenis', $project->jenis) == 'restorasi' ? 'selected' : '' }}>Restorasi</option>
                                <option value="renovasi" {{ old('jenis', $project->jenis) == 'renovasi' ? 'selected' : '' }}>Renovasi Ruangan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Pelanggan *</label>
                            <select name="customer_id" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="">Pilih pelanggan...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id', $project->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }} ({{ $customer->perusahaan ?? 'Personal' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tanggal Mulai</label>
                            <input name="tanggal_mulai" value="{{ old('tanggal_mulai', $project->tanggal_mulai ? $project->tanggal_mulai->format('Y-m-d') : '') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Target Selesai</label>
                            <input name="target_selesai" value="{{ old('target_selesai', $project->target_selesai ? $project->target_selesai->format('Y-m-d') : '') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="date"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Deskripsi Proyek</label>
                        <textarea name="deskripsi" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Jelaskan cakupan proyek..." rows="4">{{ old('deskripsi', $project->deskripsi) }}</textarea>
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
                            <option value="{{ $kayu->id }}" {{ old('jenis_kayu_id', $project->jenis_kayu_id) == $kayu->id ? 'selected' : '' }}>{{ $kayu->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Tipe Finishing</label>
                        <input name="finishing" value="{{ old('finishing', $project->finishing) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="cth., Natural Wax, Satin Varnish, PU Clear" type="text"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Dimensi Produk (cm)</label>
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Panjang</label>
                                <input name="panjang" type="number" step="0.1" value="{{ old('panjang', $project->panjang) }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Lebar</label>
                                <input name="lebar" type="number" step="0.1" value="{{ old('lebar', $project->lebar) }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                            <div>
                                <label class="block text-[10px] uppercase text-outline mb-1">Tinggi</label>
                                <input name="tinggi" type="number" step="0.1" value="{{ old('tinggi', $project->tinggi) }}" class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Estimasi Berat (kg)</label>
                        <input name="berat" type="number" step="0.1" value="{{ old('berat', $project->berat) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" placeholder="0"/>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kebutuhan Khusus / Kustomisasi Ekstra</label>
                        <textarea name="kebutuhan_khusus" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="cth., Live edge, sambungan kupu-kupu..." rows="3">{{ old('kebutuhan_khusus', $project->kebutuhan_khusus) }}</textarea>
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
                    @foreach($project->milestones as $index => $ms)
                    <div class="milestone-item flex items-center gap-4 p-4 bg-surface-container-low rounded-lg">
                        <input type="hidden" name="milestones[{{ $index }}][id]" value="{{ $ms->id }}">
                        <span class="material-symbols-outlined text-primary">
                            <input type="hidden" name="milestones[{{ $index }}][icon]" value="{{ $ms->icon ?? 'flag' }}">
                            {{ $ms->icon ?? 'flag' }}
                        </span>
                        <input type="text" name="milestones[{{ $index }}][nama]" value="{{ $ms->nama }}" class="text-sm font-bold bg-transparent border-none focus:ring-0 text-on-surface flex-1 px-0" placeholder="Nama Tahapan" required>
                        <select name="milestones[{{ $index }}][status]" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium">
                            <option value="pending" {{ $ms->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="aktif" {{ $ms->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ $ms->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <input type="date" name="milestones[{{ $index }}][tanggal_target]" value="{{ $ms->tanggal_target ? $ms->tanggal_target->format('Y-m-d') : '' }}" class="px-3 py-2 bg-surface-container-high rounded-lg border-none text-xs text-on-surface-variant font-medium w-36" placeholder="Perkiraan tanggal"/>
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
                            <input name="estimasi_pengiriman" type="date" value="{{ old('estimasi_pengiriman', $project->estimasi_pengiriman ? $project->estimasi_pengiriman->format('Y-m-d') : '') }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Tingkat Prioritas</label>
                            <select name="prioritas" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" required>
                                <option value="standar" {{ old('prioritas', $project->prioritas) == 'standar' ? 'selected' : '' }}>Standar (6-8 minggu)</option>
                                <option value="cepat" {{ old('prioritas', $project->prioritas) == 'cepat' ? 'selected' : '' }}>Cepat (3-4 minggu)</option>
                                <option value="express" {{ old('prioritas', $project->prioritas) == 'express' ? 'selected' : '' }}>Express (1-2 minggu)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Instruksi Khusus</label>
                        <textarea name="catatan" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Permintaan kustom, catatan pengiriman, atau kebutuhan khusus..." rows="3">{{ old('catatan', $project->catatan) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50 resize-none" placeholder="Alamat pengiriman lengkap..." rows="2">{{ old('alamat_pengiriman', $project->alamat_pengiriman) }}</textarea>
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
                                <input name="anggaran" type="number" value="{{ old('anggaran', $project->anggaran) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="anggaranInput"/>
                            </div>
                            <div class="flex justify-between text-sm items-center">
                                <label class="text-on-primary/70">Pajak (%)</label>
                                <input name="pajak_persen" type="number" step="0.01" value="{{ old('pajak_persen', $project->pajak_persen ?? 0) }}" class="w-20 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="pajakInput"/>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-on-primary/70">Pajak</span>
                                <span id="summaryPajak" class="font-medium">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm items-center">
                                <label class="text-on-primary/70">Ongkir (Rp)</label>
                                <input name="ongkir" type="number" value="{{ old('ongkir', $project->ongkir ?? 0) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="ongkirInput"/>
                            </div>
                            <div class="flex justify-between text-sm items-center">
                                <label class="text-on-primary/70">Diskon (Rp)</label>
                                <input name="diskon" type="number" value="{{ old('diskon', $project->diskon ?? 0) }}" class="w-28 px-2 py-1 bg-white/20 rounded text-right text-sm font-medium text-on-primary border-none focus:ring-1 focus:ring-white/50" id="diskonInput"/>
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
                            <input {{ old('metode_pembayaran', $project->metode_pembayaran ?? 'transfer_bank') == 'transfer_bank' ? 'checked' : '' }} name="metode_pembayaran" value="transfer_bank" type="radio" class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-primary text-sm">account_balance</span>
                            <span class="text-sm font-medium">Transfer Bank</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input {{ old('metode_pembayaran', $project->metode_pembayaran ?? '') == 'kartu_kredit' ? 'checked' : '' }} name="metode_pembayaran" value="kartu_kredit" type="radio" class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-primary text-sm">credit_card</span>
                            <span class="text-sm font-medium">Kartu Kredit</span>
                        </label>
                        <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                            <input {{ old('metode_pembayaran', $project->metode_pembayaran ?? '') == 'dp_pelunasan' ? 'checked' : '' }} name="metode_pembayaran" value="dp_pelunasan" type="radio" class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-primary text-sm">schedule</span>
                            <span class="text-sm font-medium">DP 50% + Pelunasan Saat Pengiriman</span>
                        </label>
                    </div>
                </div>

                <!-- Status & Progress -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <h4 class="text-sm font-bold text-primary mb-4">Status & Progress</h4>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Status Proyek</label>
                            <select name="status" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                                <option value="perencanaan" {{ old('status', $project->status) == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                <option value="aktif" {{ old('status', $project->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="ditunda" {{ old('status', $project->status) == 'ditunda' ? 'selected' : '' }}>Ditunda</option>
                                <option value="selesai" {{ old('status', $project->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $project->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Progress (%)</label>
                            <input name="progress" value="{{ old('progress', $project->progress) }}" min="0" max="100" required class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="number"/>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                    <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                    <p class="text-xs text-on-surface-variant mb-4">Hapus proyek ini secara permanen.</p>
                    <button type="button" onclick="deleteProject()" class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">delete_forever</span>
                        Hapus Proyek
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <form id="deleteForm" action="{{ route('projects.destroy', $project->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script>
    let milestoneIndex = {{ $project->milestones->count() > 0 ? $project->milestones->max('urutan') + 1 : 100 }};
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

    function deleteProject() {
        if (confirm('Yakin ingin menghapus proyek "{{ $project->nama }}"? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('deleteForm').submit();
        }
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
