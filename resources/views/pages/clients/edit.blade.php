@extends('layouts.app')

@section('title', 'Ubah ' . $customer->nama)

@section('content')
<div class="pt-28 px-10 pb-20">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8">
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('customers') }}">Pelanggan</a>
        <span class="text-outline-variant">/</span>
        <a class="text-on-surface-variant hover:text-primary transition-colors font-medium" href="{{ route('clients.show', $customer->id) }}">{{ $customer->nama }}</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-bold">Ubah</span>
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

    @if(session('error'))
    <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-lg font-medium">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('clients.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Ubah Profil Pelanggan</h2>
                <p class="text-on-surface-variant mt-1">Perbarui detail dan preferensi pelanggan</p>
            </div>
            <div class="flex gap-3">
                <a class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors flex items-center gap-2" href="{{ route('clients.show', $customer->id) }}">
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
                <!-- Personal Information -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Informasi Pribadi</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Lengkap *</label>
                            <input name="nama" value="{{ old('nama', $customer->nama) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text" required/>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat Email</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">mail</span>
                                    <input name="email" value="{{ old('email', $customer->email) }}" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="email"/>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nomor Telepon</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline text-[20px]">call</span>
                                    <input name="telepon" value="{{ old('telepon', $customer->telepon) }}" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="tel"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Alamat</label>
                            <div class="relative">
                                <span class="absolute left-4 top-4 material-symbols-outlined text-outline text-[20px]">location_on</span>
                                <textarea name="alamat" class="w-full pl-12 pr-4 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="2">{{ old('alamat', $customer->alamat) }}</textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kota</label>
                                <input name="kota" value="{{ old('kota', $customer->kota) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Provinsi</label>
                                <input name="provinsi" value="{{ old('provinsi', $customer->provinsi) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kode Pos</label>
                                <input name="kode_pos" value="{{ old('kode_pos', $customer->kode_pos) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Details -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">business_center</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Detail Bisnis</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Perusahaan</label>
                                <input name="perusahaan" value="{{ old('perusahaan', $customer->perusahaan) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Jabatan / Posisi</label>
                                <input name="jabatan" value="{{ old('jabatan', $customer->jabatan) }}" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">note</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Catatan</h3>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Catatan Internal</label>
                        <textarea name="catatan" class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium resize-none" rows="4">{{ old('catatan', $customer->catatan) }}</textarea>
                    </div>
                </div>

                <!-- Purchase History (read-only) -->
                @if($customer->orders->count() > 0)
                <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">history</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary font-headline">Riwayat Pembelian</h3>
                        <span class="px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-bold text-outline uppercase">Hanya Baca</span>
                    </div>
                    <div class="space-y-4">
                        @foreach($customer->orders->sortByDesc('tanggal_pesanan') as $order)
                        <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg">
                            <div>
                                <p class="text-sm font-bold text-on-surface">{{ $order->items->first()->product->nama_produk ?? 'Pesanan #' . $order->nomor_faktur }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $order->tanggal_pesanan->translatedFormat('d M Y') }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-primary">{{ $order->total_format }}</span>
                                @php
                                    $sClass = match($order->status) {
                                        'selesai' => 'bg-emerald-100 text-emerald-800',
                                        'dalam_produksi' => 'bg-amber-100 text-amber-800',
                                        'dikirim' => 'bg-blue-100 text-blue-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                        default => 'bg-stone-100 text-stone-800',
                                    };
                                @endphp
                                <span class="px-3 py-1 {{ $sClass }} text-[10px] font-bold uppercase rounded-full">{{ $order->status_label }}</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="pt-4 border-t border-outline-variant/20 flex justify-between items-center">
                            <span class="text-xs font-bold text-outline uppercase tracking-widest">Total Nilai Seumur Hidup</span>
                            <span class="text-xl font-black text-primary font-headline">Rp {{ number_format($lifetimeValue, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-span-4">
                <div class="sticky top-28 space-y-6">
                    <!-- Client Photo -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm text-center">
                        <div class="w-28 h-28 rounded-xl bg-primary-container mx-auto mb-4 flex items-center justify-center text-primary text-3xl font-black">
                            {{ $customer->initials }}
                        </div>
                        <p class="text-lg font-bold text-on-surface">{{ $customer->nama }}</p>
                        <p class="text-xs text-on-surface-variant">Pelanggan sejak {{ $customer->created_at->translatedFormat('M Y') }}</p>
                    </div>

                    <!-- Current Tier -->
                    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                        <h4 class="text-sm font-bold text-primary mb-4">Tingkat Loyalitas</h4>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 {{ old('status_loyalitas', $customer->status_loyalitas) == 'baru' ? 'bg-primary/10 border border-primary/20' : 'bg-surface-container-low hover:bg-primary/5' }} rounded-lg cursor-pointer transition-colors">
                                <input {{ old('status_loyalitas', $customer->status_loyalitas) == 'baru' ? 'checked' : '' }} name="status_loyalitas" value="baru" type="radio" class="text-primary focus:ring-primary"/>
                                <span class="text-sm font-medium text-on-surface">Pelanggan Baru</span>
                            </label>
                            <label class="flex items-center gap-3 p-4 {{ old('status_loyalitas', $customer->status_loyalitas) == 'reguler' ? 'bg-primary/10 border border-primary/20' : 'bg-surface-container-low hover:bg-primary/5' }} rounded-lg cursor-pointer transition-colors">
                                <input {{ old('status_loyalitas', $customer->status_loyalitas) == 'reguler' ? 'checked' : '' }} name="status_loyalitas" value="reguler" type="radio" class="text-primary focus:ring-primary"/>
                                <span class="text-sm font-medium text-on-surface">Reguler</span>
                            </label>
                            <label class="flex items-center gap-3 p-4 {{ old('status_loyalitas', $customer->status_loyalitas) == 'vip' ? 'bg-primary/10 border border-primary/20' : 'bg-surface-container-low hover:bg-primary/5' }} rounded-lg cursor-pointer transition-colors">
                                <input {{ old('status_loyalitas', $customer->status_loyalitas) == 'vip' ? 'checked' : '' }} name="status_loyalitas" value="vip" type="radio" class="text-primary focus:ring-primary"/>
                                <div>
                                    <span class="text-sm font-bold text-primary">VIP</span>
                                    <span class="material-symbols-outlined text-primary text-sm ml-1 align-middle" style="font-variation-settings: 'FILL' 1;">verified</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-error-container/20 rounded-xl p-6 border border-error/10">
                        <h4 class="text-sm font-black text-error mb-2">Zona Berbahaya</h4>
                        <p class="text-xs text-on-surface-variant mb-4">Hapus pelanggan ini dan semua catatannya secara permanen.</p>
                        <button type="button" onclick="deleteCustomer()" class="w-full py-3 border border-error/30 text-error font-bold rounded-full text-sm hover:bg-error hover:text-on-error transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">delete_forever</span>
                            Hapus Pelanggan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="deleteForm" action="{{ route('clients.destroy', $customer->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script>
    function deleteCustomer() {
        if (confirm('Yakin ingin menghapus pelanggan "{{ $customer->nama }}"? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endpush
@endsection
