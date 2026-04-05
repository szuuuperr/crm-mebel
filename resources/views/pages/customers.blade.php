@extends('layouts.app')

@section('title', 'Manajemen Pelanggan')

@section('content')
<!-- Main Content Canvas -->
<div class="pt-28 p-10 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-4xl font-extrabold text-primary mb-2 tracking-tight">Portofolio Pelanggan</h2>
                <p class="text-on-surface-variant font-medium">Membangun hubungan seumur hidup melalui keunggulan kerajinan.</p>
            </div>
            <div class="flex gap-3">
                <button class="px-6 py-2.5 rounded-full bg-surface-container-highest text-on-surface font-semibold flex items-center gap-2 hover:bg-stone-200 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">filter_list</span>
                    Filter
                </button>
                <a class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 shadow-lg shadow-primary/10 hover:scale-105 transition-transform" href="{{ route('clients.create') }}">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    Tambah Pelanggan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <!-- Customer List Section -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Stats Bar -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Pelanggan</p>
                        <h3 class="text-3xl font-black text-primary">1,284</h3>
                    </div>
                    <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Proyek Aktif</p>
                        <h3 class="text-3xl font-black text-primary">42</h3>
                    </div>
                    <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Tingkat Retensi</p>
                        <h3 class="text-3xl font-black text-primary">94%</h3>
                    </div>
                </div>

                <!-- Main List Card -->
                <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-on-surface-variant/60 text-xs font-bold uppercase tracking-wider">
                                    <th class="px-6 py-4">Informasi Pelanggan</th>
                                    <th class="px-6 py-4">Pembelian Terakhir</th>
                                    <th class="px-6 py-4 text-center">Status Loyalitas</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @php
                                    $clients = [
                                        ['name' => 'Eleanor Vance', 'email' => 'e.vance@designhouse.com', 'purchase' => 'Set Meja Makan Walnut', 'purchaseDate' => 'Dibeli 12 Okt 2023', 'status' => 'Lingkaran Elite', 'statusClass' => 'bg-primary/10 text-primary', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD8BqnZFBl0JSAaA6lYT3nJaQDuS2n0y1gAChCI30SfFvb_wqRk3BxIosw9O7Uk2N8SitQrO5MpbB1Xuuau7fcoA9ZPOVxAOdArrPFtXeCrqJDmwK8JXeGbpfOlyE0kY71GWoYSQMCN-dD80qMSKqE_pa-3nxkwKa9qqh3GTuGXKw86aXTV2sPLkqZ858Dep1OcedeMClqWQTo0wTrLZ4qF5JTEpwMVa-VnscfjXlScpI3jUeK3c9dn0pzScRbTUVPyo7F0lhWPIWUo'],
                                        ['name' => 'Marcus Sterling', 'email' => 'm.sterling@architecture.co', 'purchase' => 'Meja Live-Edge', 'purchaseDate' => 'Dibeli 04 Agu 2023', 'status' => 'Dasar', 'statusClass' => 'bg-secondary-container text-on-secondary-container', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx1WP3d3IqPnSqWepKzXqlkfoxBqUnrWUuA3Y4I2c_1ysxQTnKAc5vjd6z6MiqEbwNvNN_WC3eGeDndMFLWvYnBMj8EewBMDDnjmop6dtfh5Zhi-bPn8WOIHzmj0P-37UOQGjnAjhxO1RWeI4iecxFTD06bcLylNR7FQc0eKgNOiHVd_RlqCd-VrKnzwj1K8LzmZ0HyKQx9Xn9y60fcK7dFV0kD1KysgKw9aIbBwOmaGfigv2p0SzJjy8ca-tBcDKMSrkk-is2eJsu'],
                                        ['name' => 'Sienna Rossi', 'email' => 'sienna@rossistudios.it', 'purchase' => 'Koleksi Ottoman', 'purchaseDate' => 'Dibeli 18 Nov 2023', 'status' => 'Duta', 'statusClass' => 'bg-primary text-on-primary', 'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBYVV7ugfbwgzD1Nb5c44tn3A8IxQZZbMf7l1rCmhMgFKuuk68pEkMqA4j_0Vh2fmT6FkBZHXgzFFn8_k805Q4Fux_TdVjMLsimbVjq1NnZ0bAlU4P6x-lr9r1Dcr4tSvKonw7ZFJXOPozJLVS9yqUj-q_krz67r0GGRHnsDz-N3hE46UPgkThdzn5yENDQM4P0afBJRElIuAt667htavRIsDkxfOY4XpbPeXc920XWJVU9bkamiOOfHnv2qx9drM5R6px0AD1DE0eg'],
                                    ];
                                @endphp
                                @foreach($clients as $i => $client)
                                <tr class="group hover:bg-surface-container-low transition-colors {{ $i % 2 === 1 ? 'bg-surface-container-low/30' : '' }}">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-stone-100 overflow-hidden">
                                                <img class="w-full h-full object-cover" src="{{ $client['avatar'] }}"/>
                                            </div>
                                            <div>
                                                <p class="font-bold text-on-surface">{{ $client['name'] }}</p>
                                                <p class="text-sm text-on-surface-variant">{{ $client['email'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="font-semibold text-on-surface">{{ $client['purchase'] }}</p>
                                        <p class="text-xs text-on-surface-variant">{{ $client['purchaseDate'] }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full {{ $client['statusClass'] }} text-[11px] font-bold uppercase tracking-wider">
                                            {{ $client['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <button class="p-2 hover:bg-primary/5 rounded-full text-primary transition-colors">
                                            <span class="material-symbols-outlined">chevron_right</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-stone-100 flex items-center justify-between">
                        <p class="text-xs font-medium text-on-surface-variant">Menampilkan 1-3 dari 1.284 Pelanggan</p>
                        <div class="flex gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-stone-200 transition-colors"><span class="material-symbols-outlined text-sm">keyboard_arrow_left</span></button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary text-xs font-bold">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-stone-200 transition-colors text-xs font-bold">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-stone-200 transition-colors text-xs font-bold">3</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-stone-200 transition-colors"><span class="material-symbols-outlined text-sm">keyboard_arrow_right</span></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Individual Client Focus -->
            <div class="col-span-12 lg:col-span-4">
                <div class="sticky top-28 bg-surface-container-lowest rounded-xl shadow-xl overflow-hidden border border-outline-variant/10">
                    <div class="relative h-32 bg-primary overflow-hidden">
                        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 flex items-end gap-4 w-full translate-y-8">
                            <div class="w-24 h-24 rounded-xl ring-4 ring-surface-container-lowest bg-surface overflow-hidden shadow-lg">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpUWBr4qUVe2hxkOyYOlVRu18Ehqm1oKGr99PgIhCAD-DSISxdmJ3rAj4-zf2XhOwcXo-xyYRueP54E-xnEXA88vY6iNxr1tbbSOO9cFHbGW4IXWVzerQ-e-r90jm7hvQiZAU7-2J0an6WPhsclyn9UVHKG3Y88qrzQD76ZEBxRcTbejX1-XI3dCx_c9bt2hawWpwO51vfuaMKYFuVyasm8zJHzaPqkG3ooUqLNgrlOOshlS4nTO4q6MRH1NEjuAt02ygleeeHCHfe"/>
                            </div>
                        </div>
                    </div>
                    <div class="pt-12 px-6 pb-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-black text-on-surface">Eleanor Vance</h3>
                                <p class="text-on-surface-variant font-medium">Head of Design, DesignHouse</p>
                            </div>
                            <span class="bg-primary/10 text-primary p-2 rounded-full">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified</span>
                            </span>
                        </div>
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary text-[20px]">mail</span>
                                <span class="text-on-surface font-medium">e.vance@designhouse.com</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary text-[20px]">call</span>
                                <span class="text-on-surface font-medium">+1 (555) 234-8902</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
                                <span class="text-on-surface font-medium">Greenwich Village, NY</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-8 h-px bg-outline-variant/30"></span>
                                Riwayat Pembelian
                            </h4>
                            <div class="space-y-6 relative pl-4">
                                <div class="absolute left-0 top-1 bottom-1 w-0.5 bg-outline-variant/20 rounded-full"></div>
                                <div class="relative">
                                    <div class="absolute -left-[18.5px] top-1.5 w-2 h-2 rounded-full bg-primary ring-4 ring-surface-container-lowest"></div>
                                    <div class="bg-surface-container-low p-4 rounded-xl">
                                        <div class="flex justify-between items-start mb-1">
                                            <p class="text-sm font-bold text-on-surface">Walnut Dining Suite</p>
                                            <p class="text-[10px] font-bold text-primary">$12,400</p>
                                        </div>
                                        <p class="text-xs text-on-surface-variant">Selesai · 12 Okt 2023</p>
                                        <div class="mt-3 flex gap-1">
                                            <span class="text-[10px] bg-white px-2 py-0.5 rounded border border-stone-100">American Walnut</span>
                                            <span class="text-[10px] bg-white px-2 py-0.5 rounded border border-stone-100">8-Seater</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div class="absolute -left-[18.5px] top-1.5 w-2 h-2 rounded-full bg-primary/40 ring-4 ring-surface-container-lowest"></div>
                                    <div class="bg-surface-container-low/50 p-4 rounded-xl">
                                        <div class="flex justify-between items-start mb-1">
                                            <p class="text-sm font-bold text-on-surface">Reading Nook Armchair</p>
                                            <p class="text-[10px] font-bold text-primary">$2,850</p>
                                        </div>
                                        <p class="text-xs text-on-surface-variant">Selesai · 15 Mar 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-8 py-3 bg-surface-container-highest text-primary font-bold rounded-full hover:bg-primary hover:text-on-primary transition-all duration-300 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Perbarui Profil Pelanggan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('fab')
<a class="fixed bottom-10 right-10 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform z-50 group" href="{{ route('orders.create') }}">
    <span class="material-symbols-outlined text-3xl">add</span>
    <div class="absolute right-20 bg-primary text-on-primary px-4 py-2 rounded-lg text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
        Buat Pesanan
    </div>
</a>
@endsection
