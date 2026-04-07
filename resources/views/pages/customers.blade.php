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
                    <p class="text-on-surface-variant font-medium">Membangun hubungan seumur hidup melalui keunggulan
                        kerajinan.</p>
                </div>
                <a class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 shadow-lg shadow-primary/10 hover:scale-105 transition-transform"
                    href="{{ route('clients.create') }}">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    Tambah Pelanggan
                </a>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-400 text-white rounded-lg font-medium shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-12 gap-8">
                <!-- Customer List Section -->
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <!-- Stats Bar -->
                    <div class="grid grid-cols-3 gap-6">
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total
                                Pelanggan</p>
                            <h3 class="text-3xl font-black text-primary">{{ $totalCustomers }}</h3>
                        </div>
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Proyek Aktif
                            </p>
                            <h3 class="text-3xl font-black text-primary">{{ $activeProjects }}</h3>
                        </div>
                        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/10">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Tingkat
                                Retensi</p>
                            <h3 class="text-3xl font-black text-primary">94%</h3>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <form action="{{ route('customers') }}" method="GET" class="flex gap-2 justify-between items-center w-full">
                            <div class="flex gap-2">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan..." class="px-4 py-2.5 rounded-full bg-surface-container-highest text-on-surface text-sm focus:ring-2 focus:ring-primary w-56"/>
                                <button type="submit" class="px-4 py-2.5 rounded-full bg-primary text-on-primary font-semibold flex items-center gap-2 hover:scale-105 transition-transform">
                                    <span class="material-symbols-outlined text-[20px]">search</span>
                                </button>
                            </div>
                            <div class="flex gap-2">
                                <select name="loyalitas" class="px-4 py-2.5 w-48 rounded-full bg-surface-container-lowest text-sm font-bold text-on-surface-variant border-2 border-outline-variant/20 focus:ring-2 focus:ring-primary">
                                    <option value="">Semua Loyalitas</option>
                                    <option value="baru" {{ request('loyalitas') == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="reguler" {{ request('loyalitas') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                                    <option value="vip" {{ request('loyalitas') == 'vip' ? 'selected' : '' }}>VIP</option>
                                </select>
                                @if(request('search') || request('loyalitas'))
                                <a href="{{ route('customers') }}" class="px-4 py-2.5 rounded-full bg-surface-container-highest text-on-surface text-sm hover:bg-stone-200 transition-colors">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- Main List Card -->
                    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-on-surface-variant/60 text-xs font-bold uppercase tracking-wider">
                                        <th class="px-6 py-4">Informasi Pelanggan</th>
                                        <th class="px-6 py-4">Kontak</th>
                                        <th class="px-6 py-4 text-center">Status Loyalitas</th>
                                        <th class="px-6 py-4">Pesanan</th>
                                        <th class="px-6 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @foreach($customers as $i => $customer)
                                        <tr
                                            class="group hover:bg-surface-container-low transition-colors cursor-pointer {{ $i === 0 ? 'bg-primary/5 border-l-4 border-primary' : ($i % 2 === 1 ? 'bg-surface-container-low/30' : '') }}"
                                            onclick="selectCustomer({{ $customer->id }})"
                                            data-customer-id="{{ $customer->id }}"
                                            id="customerRow{{ $customer->id }}">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-10 h-10 text-sm shrink-0 rounded-full bg-primary-container flex items-center justify-center ">
                                                        <div class="text-on-primary-container font-bold">
                                                            {{ $customer->initials }}
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <p class="font-bold text-on-surface">{{ $customer->nama }}</p>
                                                        <p class="text-sm text-on-surface-variant">
                                                            {{ $customer->perusahaan ?? $customer->kota }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <p class="font-semibold text-on-surface text-sm">{{ $customer->email }}</p>
                                                <p class="text-xs text-on-surface-variant">{{ $customer->telepon }}</p>
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full {{ $customer->status_loyalitas === 'vip' ? 'bg-primary/10 text-primary' : ($customer->status_loyalitas === 'reguler' ? 'bg-secondary-container text-on-secondary-container' : 'bg-surface-container-high text-outline') }} text-[11px] font-bold uppercase tracking-wider">
                                                    {{ ucfirst($customer->status_loyalitas) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <span class="font-bold text-primary">{{ $customer->orders_count }}</span>
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                <a href="{{ route('clients.show', $customer->id) }}"
                                                    class="p-2 hover:bg-primary/5 rounded-full text-primary transition-colors inline-flex"
                                                    onclick="event.stopPropagation()">
                                                    <span class="material-symbols-outlined">chevron_right</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 border-t border-stone-100 flex items-center justify-between">
                            <p class="text-xs font-medium text-on-surface-variant">Menampilkan {{ $customers->firstItem() }}-{{ $customers->lastItem() }} dari {{ $totalCustomers }} Pelanggan</p>
                            <div>{{ $customers->links() }}</div>
                        </div>
                    </div>
                </div>

                <!-- Individual Client Focus -->
                <div class="col-span-12 lg:col-span-4">
                    <div id="customerDetail" class="sticky top-28 bg-surface-container-lowest rounded-xl shadow-xl overflow-hidden border border-outline-variant/10">
                        @if($featured)
                            <div class="relative h-32 bg-primary overflow-visible">
                                <div
                                    class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent">
                                </div>
                                <div class="absolute bottom-0 left-0 p-6 flex items-end gap-4 w-full translate-y-8">
                                    <div
                                        class="relative w-24 h-24 rounded-xl ring-4 ring-surface-container-lowest bg-primary-container shadow-lg flex items-center justify-center text-primary text-3xl font-black"
                                        id="detailInitials">
                                        {{ $featured->initials }}
                                    </div>
                                </div>
                            </div>
                            <div class="relative pt-12 px-6 pb-6">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <h3 class="text-2xl font-black text-on-surface" id="detailName">{{ $featured->nama }}</h3>
                                        <p class="text-on-surface-variant font-medium" id="detailPosition">
                                            {{ $featured->jabatan ? $featured->jabatan . ', ' : '' }}{{ $featured->perusahaan ?? $featured->kota }}
                                        </p>
                                    </div>
                                    <div id="detailBadge">
                                    @if($featured->status_loyalitas === 'vip')
                                        <span class="bg-primary/10 text-primary p-2 rounded-full">
                                            <span class="material-symbols-outlined"
                                                style="font-variation-settings: 'FILL' 1;">verified</span>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-center gap-3 text-sm">
                                        <span class="material-symbols-outlined text-primary text-[20px]">mail</span>
                                        <span class="text-on-surface font-medium" id="detailEmail">{{ $featured->email }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm">
                                        <span class="material-symbols-outlined text-primary text-[20px]">call</span>
                                        <span class="text-on-surface font-medium" id="detailPhone">{{ $featured->telepon }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm">
                                        <span class="material-symbols-outlined text-primary text-[20px]">location_on</span>
                                        <span class="text-on-surface font-medium" id="detailLocation">{{ $featured->kota }},
                                            {{ $featured->provinsi }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h4
                                        class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-4 flex items-center gap-2">
                                        <span class="w-8 h-px bg-outline-variant/30"></span>
                                        Riwayat Pembelian
                                    </h4>
                                    <div class="space-y-6 relative pl-4" id="detailOrders">
                                        <div class="absolute left-0 top-1 bottom-1 w-0.5 bg-outline-variant/20 rounded-full">
                                        </div>
                                        @foreach($featured->orders->sortByDesc('tanggal_pesanan')->take(3) as $order)
                                            <div class="relative">
                                                <div
                                                    class="absolute -left-[18.5px] top-1.5 w-2 h-2 rounded-full bg-primary ring-4 ring-surface-container-lowest">
                                                </div>
                                                <div class="bg-surface-container-low p-4 rounded-xl">
                                                    <div class="flex justify-between items-start mb-1">
                                                        <p class="text-sm font-bold text-on-surface">
                                                            {{ $order->items->first()->product->nama_produk ?? 'Pesanan' }}
                                                        </p>
                                                        <p class="text-[10px] font-bold text-primary">{{ $order->total_format }}</p>
                                                    </div>
                                                    <p class="text-xs text-on-surface-variant">{{ $order->status_label }} ·
                                                        {{ $order->tanggal_pesanan->translatedFormat('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <a href="{{ route('clients.edit', $featured->id) }}" id="detailEditLink"
                                    class="w-full mt-8 py-3 bg-surface-container-highest text-primary font-bold rounded-full hover:bg-primary hover:text-on-primary transition-all duration-300 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                    Perbarui Profil Pelanggan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const customersData = @json($customersData);

    function selectCustomer(id) {
        const customer = customersData.find(c => c.id === id);
        if (!customer) return;

        // Update active row
        document.querySelectorAll('tbody tr').forEach(tr => {
            tr.classList.remove('bg-primary/5', 'border-l-4', 'border-primary');
        });
        const activeRow = document.getElementById('customerRow' + id);
        if (activeRow) {
            activeRow.classList.add('bg-primary/5', 'border-l-4', 'border-primary');
        }

        // Update sidebar detail
        document.getElementById('detailInitials').textContent = customer.initials;
        document.getElementById('detailName').textContent = customer.nama;
        const positionText = [customer.jabatan, customer.perusahaan || customer.kota].filter(Boolean).join(', ');
        document.getElementById('detailPosition').textContent = positionText || '-';

        // Badge
        const badgeEl = document.getElementById('detailBadge');
        if (customer.status_loyalitas === 'vip') {
            badgeEl.innerHTML = '<span class="bg-primary/10 text-primary p-2 rounded-full"><span class="material-symbols-outlined" style="font-variation-settings: \'FILL\' 1;">verified</span></span>';
        } else {
            badgeEl.innerHTML = '';
        }

        // Contact info
        document.getElementById('detailEmail').textContent = customer.email || 'Belum ada email';
        document.getElementById('detailPhone').textContent = customer.telepon || 'Belum ada telepon';
        const locationText = [customer.kota, customer.provinsi].filter(Boolean).join(', ');
        document.getElementById('detailLocation').textContent = locationText || '-';

        // Orders history
        const ordersContainer = document.getElementById('detailOrders');
        ordersContainer.innerHTML = '<div class="absolute left-0 top-1 bottom-1 w-0.5 bg-outline-variant/20 rounded-full"></div>';

        if (customer.orders && customer.orders.length > 0) {
            customer.orders.forEach(order => {
                ordersContainer.innerHTML += `
                    <div class="relative">
                        <div class="absolute -left-[18.5px] top-1.5 w-2 h-2 rounded-full bg-primary ring-4 ring-surface-container-lowest"></div>
                        <div class="bg-surface-container-low p-4 rounded-xl">
                            <div class="flex justify-between items-start mb-1">
                                <p class="text-sm font-bold text-on-surface">${order.produk}</p>
                                <p class="text-[10px] font-bold text-primary">${order.total_format}</p>
                            </div>
                            <p class="text-xs text-on-surface-variant">${order.status_label} · ${order.tanggal}</p>
                        </div>
                    </div>
                `;
            });
        } else {
            ordersContainer.innerHTML += '<p class="text-sm text-on-surface-variant text-center py-4">Belum ada riwayat pesanan.</p>';
        }

        // Edit link
        document.getElementById('detailEditLink').href = '/clients/' + id + '/edit';
    }
</script>
@endpush
