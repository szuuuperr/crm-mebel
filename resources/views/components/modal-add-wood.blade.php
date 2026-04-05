{{-- Modal Add Wood Type --}}
{{-- Usage: @section('modals') @include('components.modal-add-wood') @endsection, then use openModal('modal-add-wood') --}}
<div class="fixed inset-0 z-50 flex items-center justify-center p-4" id="modal-add-wood" style="display: none;">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeModal('modal-add-wood')"></div>

    <!-- Modal -->
    <div class="relative bg-surface-container-lowest rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden animate-in">
        <!-- Header -->
        <div class="bg-primary px-8 py-6 relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 opacity-10">
                <span class="material-symbols-outlined text-[100px]">forest</span>
            </div>
            <div class="relative z-10 flex justify-between items-center">
                <div class="text-on-primary">
                    <h3 class="text-xl font-bold font-headline">Tambah Jenis Kayu Utama</h3>
                    <p class="text-on-primary/70 text-sm mt-0.5">Perluas inventaris material bengkel Anda</p>
                </div>
                <button class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-on-primary transition-colors" onclick="closeModal('modal-add-wood')">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>

        <!-- Body -->
        <div class="px-8 py-6 space-y-6">
            <!-- Wood Name -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Nama Kayu *</label>
                <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="e.g., Black Cherry, Birch..." type="text"/>
            </div>

            <!-- Color Swatch -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-3">Palet Warna *</label>
                <div class="flex items-center gap-4">
                    <div class="flex flex-wrap gap-2">
                        @php $swatches = ['#4a3728','#c19a6b','#96694c','#4E2A1E','#8E593C','#E5D3B3','#D2B48C','#2c1810','#a0522d','#deb887']; @endphp
                        @foreach($swatches as $i => $sw)
                        <button class="w-10 h-10 rounded-lg border-2 border-transparent hover:border-primary/50 hover:scale-110 transition-all {{ $i === 0 ? 'ring-2 ring-primary ring-offset-2' : '' }}" style="background-color: {{ $sw }}"></button>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2 pl-4 border-l border-outline-variant/20">
                        <label class="text-[10px] text-outline font-bold">Kustom:</label>
                        <input class="w-10 h-10 rounded-lg cursor-pointer border-none" type="color" value="#4a3728"/>
                    </div>
                </div>
            </div>

            <!-- Grade & Stock -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Kelas</label>
                    <select class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium">
                        <option>Pilih kelas...</option>
                        <option>FAS (First & Seconds)</option>
                        <option>Select</option>
                        <option>#1 Common</option>
                        <option>#2 Common</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Stok Awal (Slab)</label>
                    <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" min="0" placeholder="0" type="number"/>
                </div>
            </div>

            <!-- Origin -->
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-widest mb-2">Asal / Pemasok</label>
                <input class="w-full px-5 py-4 bg-surface-container-high rounded-lg border-none focus:ring-2 focus:ring-primary-container text-on-surface font-medium placeholder:text-on-surface-variant/50" placeholder="e.g., Pacific Northwest, WoodCraft Co." type="text"/>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-6 bg-surface-container-low flex justify-end gap-3">
            <button class="px-6 py-3 border-2 border-outline-variant/30 text-on-surface-variant font-bold rounded-full hover:bg-surface-container-high transition-colors" onclick="closeModal('modal-add-wood')">
                Batal
            </button>
            <button class="px-8 py-3 bg-primary text-on-primary font-bold rounded-full shadow-xl shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Jenis Kayu
            </button>
        </div>
    </div>
</div>
