{{-- Modal Export File --}}
{{-- Usage: @section('modals') @include('components.modal-export') @endsection, then use openModal('modal-export') --}}
<div class="fixed inset-0 z-50 flex items-center justify-center p-4" id="modal-export" style="display: none;">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('modal-export')"></div>

    <!-- Modal -->
    <div class="relative bg-surface-container-lowest rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-primary px-8 py-6 relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 opacity-10">
                <span class="material-symbols-outlined text-[100px]">cloud_download</span>
            </div>
            <div class="relative z-10 flex justify-between items-center">
                <div class="text-on-primary">
                    <h3 class="text-xl font-bold font-headline">Ekspor Data</h3>
                    <p class="text-on-primary/70 text-sm mt-0.5">Unduh catatan data Anda</p>
                </div>
                <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-on-primary transition-colors" onclick="closeModal('modal-export')">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>

        <!-- Body -->
        <form action="{{ route('export') }}" method="GET">
        <div class="px-8 py-6 space-y-6 overflow-y-auto max-h-[60vh]">
            <!-- Format Selection -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Format File</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="cursor-pointer">
                        <input checked class="sr-only peer" name="export-format" type="radio"/>
                        <div class="p-4 rounded-xl border-2 border-outline-variant/20 text-center peer-checked:border-primary peer-checked:bg-primary/5 hover:border-primary/30 transition-all">
                            <span class="material-symbols-outlined text-2xl text-primary mb-1">table_chart</span>
                            <p class="text-sm font-bold text-on-surface">CSV</p>
                            <p class="text-[10px] text-on-surface-variant">Spreadsheet</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="export-format" type="radio"/>
                        <div class="p-4 rounded-xl border-2 border-outline-variant/20 text-center peer-checked:border-primary peer-checked:bg-primary/5 hover:border-primary/30 transition-all">
                            <span class="material-symbols-outlined text-2xl text-primary mb-1">picture_as_pdf</span>
                            <p class="text-sm font-bold text-on-surface">PDF</p>
                            <p class="text-[10px] text-on-surface-variant">Dokumen</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="sr-only peer" name="export-format" type="radio"/>
                        <div class="p-4 rounded-xl border-2 border-outline-variant/20 text-center peer-checked:border-primary peer-checked:bg-primary/5 hover:border-primary/30 transition-all">
                            <span class="material-symbols-outlined text-2xl text-primary mb-1">grid_on</span>
                            <p class="text-sm font-bold text-on-surface">Excel</p>
                            <p class="text-[10px] text-on-surface-variant">.xlsx</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Date Range -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Rentang Tanggal</label>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] text-on-surface-variant font-bold mb-1">Dari</label>
                        <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" name="date_start" type="date" value="{{ date('Y-m-01') }}"/>
                    </div>
                    <div>
                        <label class="block text-[10px] text-on-surface-variant font-bold mb-1">Sampai</label>
                        <input class="w-full px-4 py-3 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium text-sm" name="date_end" type="date" value="{{ date('Y-m-t') }}"/>
                    </div>
                </div>
            </div>

            <!-- Data Selection -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Data yang Diekspor</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                        <input checked class="text-primary focus:ring-primary rounded" type="radio" name="export-data"/>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Semua Data</p>
                            <p class="text-[10px] text-on-surface-variant">Ekspor seluruh riwayat transaksi</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                        <input class="text-primary focus:ring-primary rounded" type="radio" name="export-data"/>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Filter Saat Ini</p>
                            <p class="text-[10px] text-on-surface-variant">Ekspor hanya hasil yang difilter</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-4 bg-surface-container-low rounded-lg cursor-pointer hover:bg-primary/5 transition-colors">
                        <input class="text-primary focus:ring-primary rounded" type="radio" name="export-data"/>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Item Terpilih</p>
                            <p class="text-[10px] text-on-surface-variant">Ekspor hanya baris yang dipilih manual</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Include Options -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Sertakan</label>
                <div class="flex flex-wrap gap-3">
                    @php $includes = ['Detail Pesanan','Info Pelanggan','Status Pembayaran','Tracking Pengiriman','Spesifikasi Produk']; @endphp
                    @foreach($includes as $i => $inc)
                    <label class="cursor-pointer">
                        <input {{ $i < 3 ? 'checked' : '' }} class="sr-only peer" type="checkbox"/>
                        <div class="px-4 py-2 rounded-full border-2 border-outline-variant/20 text-xs font-bold text-on-surface-variant peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:text-primary hover:border-primary/30 transition-all">{{ $inc }}</div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-6 bg-surface-container-low flex justify-between items-center">
            <p class="text-xs text-on-surface-variant"><span class="font-bold text-on-surface">{{ $totalExportData ?? 0 }}</span> data akan diekspor</p>
            <div class="flex gap-3">
                <button type="button" class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" onclick="closeModal('modal-export')">
                    Batal
                </button>
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Ekspor
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
