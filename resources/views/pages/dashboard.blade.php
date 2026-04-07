@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Dashboard Canvas -->
<div class="pt-32 px-10 pb-20">
    <!-- Header Title -->
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight">Dashboard</h2>
            <p class="text-on-surface-variant font-medium mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="flex gap-3">
            <button onclick="openModal('modal-export')" class="px-6 py-2 bg-secondary-container text-on-secondary-container rounded-full text-sm font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">download</span>
                Export Laporan
            </button>
        </div>
    </div>

    <!-- Bento Grid Metrics -->
    <div class="grid grid-cols-12 gap-6 mb-10">
        <!-- Sales Overview Chart Widget -->
        <div class="col-span-8 bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-primary">Kinerja Penjualan</h3>
                <div class="flex gap-2 text-xs font-bold text-outline uppercase tracking-tighter">
                    <button id="btnWeekly" onclick="switchChart('weekly')" class="px-3 py-1 bg-surface-container rounded-full cursor-pointer hover:bg-surface-container-high transition-colors">Mingguan</button>
                    <button id="btnMonthly" onclick="switchChart('monthly')" class="px-3 py-1 text-primary border border-primary rounded-full cursor-pointer hover:bg-primary/5 transition-colors">Bulanan</button>
                </div>
            </div>
            <div class="h-64 px-2 relative">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Secondary Summary Widgets -->
        <div class="col-span-4 flex flex-col gap-6">
            <div class="bg-primary text-on-primary rounded-xl p-6 flex flex-col justify-between h-1/2 shadow-lg relative overflow-hidden">
                <div class="z-10">
                    <p class="text-primary-fixed-dim text-sm font-medium mb-1">Total Pendapatan</p>
                    <h4 class="text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                </div>
                <div class="flex items-center gap-2 z-10">
                    <span class="material-symbols-outlined text-green-400 text-sm">trending_up</span>
                    <span class="text-xs font-bold text-primary-fixed">+12.5% dari bulan lalu</span>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">account_balance_wallet</span>
                </div>
            </div>
            <div class="bg-secondary-container rounded-xl p-6 flex flex-col justify-between h-1/2 shadow-sm relative overflow-hidden">
                <div class="z-10">
                    <p class="text-on-secondary-container/60 text-sm font-medium mb-1">Proyek Aktif</p>
                    <h4 class="text-3xl font-extrabold text-on-secondary-container tracking-tight">{{ $orderAktif }} Pesanan</h4>
                </div>
                <div class="flex items-center gap-2 z-10">
                    <span class="material-symbols-outlined text-on-secondary-container text-sm">pending_actions</span>
                    <span class="text-xs font-bold text-on-secondary-container">{{ $nearDeadline }} mendekati deadline</span>
                </div>
                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <span class="material-symbols-outlined text-[100px]">carpenter</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Grid -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Ongoing Projects -->
        <div class="col-span-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-primary">Proyek Berjalan</h3>
                <a class="text-sm font-bold text-primary hover:underline" href="{{ route('projects.index') }}">Lihat Semua</a>
            </div>
            <div class="space-y-4">


                @foreach($projects as $project)
                <div class="bg-surface-container-low rounded-lg p-6 flex items-center justify-between group hover:bg-surface-container-lowest transition-all duration-300 block">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-surface-container-high flex-shrink-0 flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-primary">carpenter</span>
                        </div>
                        <div>
                            <h5 class="font-bold text-primary">{{ $project->nama }}</h5>
                            <p class="text-sm text-on-surface-variant font-medium">Client: {{ $project->customer->nama ?? '-' }}@if($project->order) • Order #{{ $project->order->nomor_faktur }}@endif</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-8">
                        <div class="text-right">
                            <p class="text-xs font-bold text-outline mb-1 uppercase tracking-wider">Status</p>
                            <span class="px-4 py-1 {{ $project->status_class }} text-[10px] font-black rounded-full">{{ $project->status_label }}</span>
                        </div>
                        <div class="w-32 h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $project->progress }}%"></div>
                        </div>
                        <a href="{{ route('projects.show', $project->id) }}" class="w-10 h-10 rounded-full bg-surface-container-lowest flex items-center justify-center text-primary shadow-sm group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- New Customers & Materials Swatches -->
        <div class="col-span-4 space-y-6">
            <!-- New Customers Card -->
            <div class="bg-surface-container-high rounded-xl p-8">
                <h3 class="text-xl font-bold text-primary mb-6">Permintaan Terbaru</h3>
                <div class="space-y-6">
                    @foreach($recentOrders as $order)
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs">
                            {{ $order->customer->initials }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-primary">{{ $order->customer->nama }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->items->first()?->product?->nama_produk ?? 'Pesanan Baru' }}</p>
                        </div>
                        <a href="{{ route('sales.show', $order->id) }}" class="ml-auto text-primary">
                            <span class="material-symbols-outlined text-xl">mail</span>
                        </a>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('customers') }}" class="w-full mt-8 py-3 border border-primary/20 rounded-full text-xs font-bold text-primary hover:bg-primary/5 transition-colors text-center block">
                    Kelola Semua Prospek
                </a>
            </div>

            <!-- Material Stock Level -->
            <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
                <h3 class="text-xl font-bold text-primary mb-4">Stok Bahan Baku</h3>
                <div class="space-y-4">
                    @forelse($woodTypes as $wood)
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-4 h-4 rounded-full" style="background-color: {{ $wood->kode_warna ?: '#8B7355' }}"></div>
                            <span class="text-xs font-bold text-primary">{{ $wood->nama }}</span>
                        </div>
                        @if($wood->products_count <= 3)
                        <span class="text-xs font-bold text-error">Stok Menipis ({{ $wood->products_count }} produk)</span>
                        @elseif($wood->products_count <= 10)
                        <span class="text-xs font-bold text-on-secondary-container">Stok Cukup ({{ $wood->products_count }} produk)</span>
                        @else
                        <span class="text-xs font-bold text-green-600">Stok Aman ({{ $wood->products_count }} produk)</span>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <p class="text-sm text-on-surface-variant">Belum ada data jenis kayu.</p>
                    </div>
                    @endforelse
                    @if($lowStockProducts > 0)
                    <div class="pt-3 border-t border-outline-variant/20">
                        <div class="flex items-center gap-2 text-xs text-error font-bold">
                            <span class="material-symbols-outlined text-sm">warning</span>
                            {{ $lowStockProducts }} produk memiliki stok rendah (≤5)
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const weeklyData = @json($chartData);
    const monthlyData = @json($monthlyChartData);
    let currentMode = 'weekly';
    let chartInstance = null;

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        // Buat gradien untuk bar
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, '#5d4037'); // primary-container
        gradient.addColorStop(1, '#ffdbd0'); // primary-fixed

        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: weeklyData.map(d => d.label),
                datasets: [
                    {
                        type: 'line',
                        label: 'Total Keseluruhan',
                        data: weeklyData.map(d => d.total_value),
                        borderColor: '#5d4037', // primary
                        borderWidth: 3,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#5d4037',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        yAxisID: 'y'
                    },
                    {
                        type: 'bar',
                        label: 'Penjualan',
                        data: weeklyData.map(d => d.sales_value),
                        backgroundColor: '#8d6e63', // slightly lighter brown
                        borderRadius: {topLeft: 0, topRight: 0, bottomLeft: 4, bottomRight: 4},
                        barPercentage: 0.5,
                        stack: 'Stack 0',
                    },
                    {
                        type: 'bar',
                        label: 'Proyek',
                        data: weeklyData.map(d => d.project_value),
                        backgroundColor: '#d7ccc8', // light brown
                        borderRadius: {topLeft: 4, topRight: 4, bottomLeft: 0, bottomRight: 0},
                        barPercentage: 0.5,
                        stack: 'Stack 0',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1a1c1c', // on-surface
                        titleColor: '#ffffff',
                        bodyColor: '#e2e2e2',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        grid: {
                            color: '#e8e8e7', // outline-variant/20
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#504441', // on-surface-variant
                            font: { family: 'Work Sans', weight: '500' },
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                }
                                return 'Rp ' + value;
                            }
                        },
                        border: { display: false }
                    },
                    x: {
                        stacked: true,
                        grid: { display: false },
                        ticks: {
                            color: '#504441', // on-surface-variant
                            font: { family: 'Work Sans', weight: 'bold' }
                        },
                        border: { display: false }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
            }
        });
    });

    function switchChart(mode) {
        if (mode === currentMode || !chartInstance) return;
        currentMode = mode;

        const btnWeekly = document.getElementById('btnWeekly');
        const btnMonthly = document.getElementById('btnMonthly');

        let targetData = mode === 'weekly' ? weeklyData : monthlyData;

        if (mode === 'weekly') {
            btnWeekly.className = 'px-3 py-1 bg-surface-container rounded-full cursor-pointer hover:bg-surface-container-high transition-colors';
            btnMonthly.className = 'px-3 py-1 text-primary border border-primary rounded-full cursor-pointer hover:bg-primary/5 transition-colors';
        } else {
            btnMonthly.className = 'px-3 py-1 bg-surface-container rounded-full cursor-pointer hover:bg-surface-container-high transition-colors';
            btnWeekly.className = 'px-3 py-1 text-primary border border-primary rounded-full cursor-pointer hover:bg-primary/5 transition-colors';
        }

        // Update data
        chartInstance.data.labels = targetData.map(d => d.label);
        chartInstance.data.datasets[0].data = targetData.map(d => d.total_value);
        chartInstance.data.datasets[1].data = targetData.map(d => d.sales_value);
        chartInstance.data.datasets[2].data = targetData.map(d => d.project_value);
        
        // Update Chart
        chartInstance.update();
    }
</script>
@endpush

@section('modals')
@include('components.modal-export')
@endsection
