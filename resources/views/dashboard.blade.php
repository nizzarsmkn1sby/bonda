@extends('layouts.app')

@section('title', 'Dasbor | BONDAA')

@section('content')

<style>
    /* ---- Grid System ---- */
    .grid { display: grid; }
    .grid-2 { grid-template-columns: repeat(2, 1fr); }
    .grid-3 { grid-template-columns: repeat(3, 1fr); }

    @media (max-width: 1024px) {
        .grid-2, .grid-3 { grid-template-columns: 1fr; }
    }

    /* ---- Page Header ---- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    .page-title h1 { font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 5px; }
    .page-title p  { color: var(--text-muted); font-size: 14px; }

    /* ---- Bento Stat Cards ---- */
    .bento-stats { gap: 20px; margin-bottom: 28px; }

    .bento-card-stat {
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }
    .bento-card-stat:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }
    .primary-stat {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
    }
    .primary-stat .bento-stat-label { color: rgba(255,255,255,0.7); }
    .primary-stat .bento-stat-value { color: #fff; }
    .primary-stat .bento-stat-icon  { background: rgba(255,255,255,0.15); }

    .bento-stat-icon {
        width: 58px; height: 58px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }
    .bento-stat-label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }
    .bento-stat-value {
        font-size: 24px;
        font-weight: 900;
        margin: 0;
        color: var(--primary);
    }

    /* ---- Action Cards ---- */
    .action-card {
        display: flex;
        align-items: center;
        gap: 28px;
        padding: 36px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }
    .action-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(37,99,235,0.06), transparent);
        opacity: 0;
        transition: var(--transition);
    }
    .action-card:hover::before { opacity: 1; }
    .action-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }

    .action-icon {
        font-size: 62px;
        transition: var(--transition);
        z-index: 1;
        flex-shrink: 0;
    }
    .action-card:hover .action-icon { transform: scale(1.1) rotate(4deg); }
    .action-content { z-index: 1; }
    .action-title {
        font-size: 18px; font-weight: 900;
        color: var(--text-main);
        margin-bottom: 6px; letter-spacing: 0.5px;
    }
    .action-desc {
        color: var(--text-muted); font-size: 13px;
        margin-bottom: 20px; max-width: 280px;
    }
    .action-btn     { padding: 10px 22px; font-size: 13px; }
    .action-btn-alt {
        padding: 10px 22px; font-size: 13px;
        border: 1px solid var(--border);
        color: var(--text-main); background: white;
        border-radius: 10px; font-weight: 600;
        cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
    }

    @media (max-width: 768px) {
        .action-card { flex-direction: column; text-align: center; gap: 16px; }
    }

    /* ---- Chart Cards ---- */
    .chart-card {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--border);
        padding: 28px;
        box-shadow: var(--shadow);
    }
    .chart-card-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }
    .chart-card-header h3 {
        font-size: 16px; font-weight: 800; color: var(--text-main);
        margin: 0;
    }
    .chart-badge {
        font-size: 11px; font-weight: 700;
        background: rgba(37,99,235,0.08);
        color: var(--primary);
        padding: 4px 10px; border-radius: 100px;
    }
    .chart-wrapper { position: relative; height: 280px; }
    .chart-wrapper-donut { position: relative; height: 260px; }

    /* Empty state for charts */
    .chart-empty {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        height: 100%;
        color: var(--text-muted); font-size: 14px;
    }
    .chart-empty span { font-size: 40px; margin-bottom: 12px; opacity: 0.4; }
</style>

{{-- =========================================================
     PAGE HEADER
     ========================================================= --}}
<div class="page-header">
    <div class="page-title">
        <h1>Ringkasan Operasional</h1>
        <p>Selamat datang kembali, {{ auth()->user()->name }}! Berikut adalah ikhtisar bisnis Anda hari ini.</p>
    </div>
    <div style="background: rgba(37,99,235,0.08); color: var(--primary); padding: 8px 16px; border-radius: 12px; font-weight: 700; font-size: 12px; border: 1px solid rgba(37,99,235,0.2);">
        LEVEL AKSES: {{ strtoupper(auth()->user()->role->name) }}
    </div>
</div>

{{-- =========================================================
     STAT CARDS — OWNER
     ========================================================= --}}
@if(auth()->user()->isOwner())
<div class="grid grid-3 bento-stats">
    <div class="bento-card-stat primary-stat">
        <div class="bento-stat-icon">💴</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Pendapatan Hari Ini</span>
            <h2 class="bento-stat-value">Rp {{ number_format($todaySales ?? 0, 0, ',', '.') }}</h2>
        </div>
    </div>
    <div class="bento-card-stat">
        <div class="bento-stat-icon">📝</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Total Transaksi</span>
            <h2 class="bento-stat-value">{{ $todayTransactions ?? 0 }}</h2>
        </div>
    </div>
    <div class="bento-card-stat">
        <div class="bento-stat-icon">🍱</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Katalog Produk</span>
            <h2 class="bento-stat-value">{{ $totalProducts ?? 0 }}</h2>
        </div>
    </div>
</div>
@endif

{{-- =========================================================
     STAT CARDS — CASHIER
     ========================================================= --}}
@if(auth()->user()->isCashier())
<div class="grid grid-2 bento-stats">
    <div class="bento-card-stat primary-stat">
        <div class="bento-stat-icon">💴</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Penjualan Saya Hari Ini</span>
            <h2 class="bento-stat-value">Rp {{ number_format($todayMySales ?? 0, 0, ',', '.') }}</h2>
        </div>
    </div>
    <div class="bento-card-stat">
        <div class="bento-stat-icon">📝</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Transaksi Saya Hari Ini</span>
            <h2 class="bento-stat-value">{{ $todayMyTransactions ?? 0 }}</h2>
        </div>
    </div>
</div>
@endif

{{-- =========================================================
     QUICK ACTIONS
     ========================================================= --}}
<div class="grid grid-2 action-grid" style="gap: 24px; margin-bottom: 32px;">
    @if(auth()->user()->isOwner() || auth()->user()->isCashier())
    <div class="card action-card" onclick="window.location='{{ route('pos.index') }}'">
        <div class="action-icon">🏮</div>
        <div class="action-content">
            <h3 class="action-title">TERMINAL KASIR</h3>
            <p class="action-desc">Mulai sesi penjualan baru dengan antarmuka modern.</p>
            <div class="btn btn-primary action-btn">Luncurkan ⛩️</div>
        </div>
    </div>
    @endif

    @if(auth()->user()->isOwner())
    <div class="card action-card secondary" onclick="window.location='{{ route('products.index') }}'">
        <div class="action-icon">📦</div>
        <div class="action-content">
            <h3 class="action-title">MANAJEMEN STOK</h3>
            <p class="action-desc">Kelola inventaris, harga, dan kategori produk.</p>
            <button class="action-btn-alt">Atur Produk</button>
        </div>
    </div>
    @endif
</div>

{{-- =========================================================
     CHARTS — OWNER ONLY
     ========================================================= --}}
@if(auth()->user()->isOwner())

{{-- Prepare data safely --}}
@php
    $salesLabels  = [];
    $salesValues  = [];
    foreach(($salesChart ?? []) as $row) {
        $salesLabels[] = $row['date'] ?? $row->date ?? '';
        $salesValues[] = (float)($row['total'] ?? $row->total ?? 0);
    }

    $catLabels = [];
    $catValues = [];
    foreach(($categoryChart ?? []) as $row) {
        $row = is_array($row) ? $row : (array)$row;
        if(($row['count'] ?? 0) > 0) {
            $catLabels[] = $row['name'];
            $catValues[] = (int)$row['count'];
        }
    }
@endphp

<div class="grid grid-2" style="gap: 24px;">

    {{-- ---- Sales Line Chart ---- --}}
    <div class="chart-card">
        <div class="chart-card-header">
            <h3>📈 Tren Penjualan</h3>
            <span class="chart-badge">7 Hari Terakhir</span>
        </div>
        <div class="chart-wrapper">
            @if(count($salesLabels) > 0)
                <canvas id="salesChart"></canvas>
            @else
                <div class="chart-empty">
                    <span>📊</span>
                    <p>Belum ada data transaksi untuk ditampilkan.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ---- Category Doughnut Chart ---- --}}
    <div class="chart-card">
        <div class="chart-card-header">
            <h3>🏷️ Distribusi Produk</h3>
            <span class="chart-badge">per Kategori</span>
        </div>
        <div class="chart-wrapper-donut">
            @if(count($catLabels) > 0)
                <canvas id="categoryChart"></canvas>
            @else
                <div class="chart-empty">
                    <span>📂</span>
                    <p>Belum ada kategori produk yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
(function () {
    // ---- Palette ----
    var blue    = '#2563eb';
    var blueAlpha = 'rgba(37, 99, 235, 0.12)';
    var palette = ['#2563eb','#60a5fa','#34d399','#f59e0b','#f87171','#a78bfa','#38bdf8','#fb923c'];

    // ---- Sales Chart ----
    var salesEl = document.getElementById('salesChart');
    if (salesEl) {
        var salesLabels = @json($salesLabels);
        var salesValues = @json($salesValues);

        new Chart(salesEl.getContext('2d'), {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: salesValues,
                    borderColor: blue,
                    backgroundColor: blueAlpha,
                    fill: true,
                    tension: 0.45,
                    borderWidth: 3,
                    pointBackgroundColor: blue,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#94a3b8',
                        bodyColor: '#fff',
                        padding: 12,
                        borderColor: '#334155',
                        borderWidth: 1,
                        callbacks: {
                            label: function(ctx) {
                                return '  Rp ' + ctx.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            callback: function(v) {
                                if (v >= 1000000) return 'Rp ' + (v/1000000).toFixed(1) + 'jt';
                                if (v >= 1000)    return 'Rp ' + (v/1000).toFixed(0) + 'rb';
                                return 'Rp ' + v;
                            }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 11 } }
                    }
                }
            }
        });
    }

    // ---- Category Doughnut ----
    var catEl = document.getElementById('categoryChart');
    if (catEl) {
        var catLabels = @json($catLabels);
        var catValues = @json($catValues);

        new Chart(catEl.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: catLabels,
                datasets: [{
                    data: catValues,
                    backgroundColor: palette.slice(0, catLabels.length),
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18,
                            color: '#475569',
                            font: { size: 12, weight: '600' }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#94a3b8',
                        bodyColor: '#fff',
                        padding: 12,
                        callbacks: {
                            label: function(ctx) {
                                var total = ctx.dataset.data.reduce(function(a,b){ return a+b; }, 0);
                                var pct   = ((ctx.raw / total) * 100).toFixed(1);
                                return '  ' + ctx.raw + ' produk (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
})();
</script>

@endif {{-- end isOwner --}}

@endsection
