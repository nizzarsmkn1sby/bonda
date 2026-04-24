<?php $__env->startSection('title', 'Dasbor | BONDAA'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-title">
        <h1>Ringkasan Operasional</h1>
        <p>Selamat datang kembali, <?php echo e(auth()->user()->name); ?>! Berikut adalah ikhtisar bisnis Anda hari ini.</p>
    </div>
    <div>
        <div style="background: var(--primary-light); color: var(--primary); padding: 8px 16px; border-radius: 12px; font-weight: 700; font-size: 12px; border: 1px solid var(--primary);">
            LEVEL AKSES: <?php echo e(strtoupper(auth()->user()->role->name)); ?>

        </div>
    </div>
</div>


<div class="grid grid-3 bento-stats" style="margin-bottom: 40px;">
    <?php if(auth()->user()->isOwner()): ?>
    <div class="bento-card-stat primary-stat">
        <div class="bento-stat-icon">💴</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Pendapatan Hari Ini</span>
            <h2 class="bento-stat-value">Rp <?php echo e(number_format($todaySales ?? 0, 0, ',', '.')); ?></h2>
        </div>
    </div>
    
    <div class="bento-card-stat">
        <div class="bento-stat-icon">📝</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Total Transaksi</span>
            <h2 class="bento-stat-value"><?php echo e($todayTransactions ?? 0); ?></h2>
        </div>
    </div>
    
    <div class="bento-card-stat">
        <div class="bento-stat-icon">🍱</div>
        <div class="bento-stat-info">
            <span class="bento-stat-label">Katalog Produk</span>
            <h2 class="bento-stat-value"><?php echo e($totalProducts ?? 0); ?></h2>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="grid grid-2 action-grid">
    <!-- Quick Actions -->
    <?php if(auth()->user()->isOwner() || auth()->user()->isCashier()): ?>
    <div class="card action-card" onclick="window.location='<?php echo e(route('pos.index')); ?>'">
        <div class="action-icon">🏮</div>
        <div class="action-content">
            <h3 class="action-title">TERMINAL KASIR</h3>
            <p class="action-desc">Mulai sesi penjualan baru dengan antarmuka modern.</p>
            <div class="btn btn-primary action-btn">Luncurkan ⛩️</div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isOwner()): ?>
    <div class="card action-card secondary" onclick="window.location='<?php echo e(route('products.index')); ?>'">
        <div class="action-icon">📦</div>
        <div class="action-content">
            <h3 class="action-title">MANAJEMEN STOK</h3>
            <p class="action-desc">Kelola inventaris, harga, dan kategori produk.</p>
            <div class="btn action-btn-alt">Atur Produk</div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    .bento-stats {
        gap: 20px;
    }
    .bento-card-stat {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: var(--transition);
    }
    .bento-card-stat:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
    }
    .primary-stat {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
    }
    .primary-stat .bento-stat-label { color: rgba(255,255,255,0.7); }
    .primary-stat .bento-stat-value { color: #fff; }
    .primary-stat .bento-stat-icon { background: rgba(255,255,255,0.1); }

    .bento-stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(0,0,0,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }
    .bento-stat-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }
    .bento-stat-value {
        font-size: 26px;
        font-weight: 900;
        margin: 0;
        color: var(--primary);
    }

    .action-card {
        display: flex;
        align-items: center;
        gap: 30px;
        padding: 40px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .action-card::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: linear-gradient(to right, var(--primary-light), transparent);
        opacity: 0;
        transition: var(--transition);
    }
    .action-card:hover::before {
        opacity: 1;
    }
    .action-icon {
        font-size: 70px;
        filter: drop-shadow(0 0 10px rgba(229,57,53,0.3));
        transition: var(--transition);
        z-index: 1;
    }
    .action-card:hover .action-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .action-content {
        z-index: 1;
    }
    .action-title {
        font-size: 20px;
        font-weight: 900;
        color: #fff;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .action-desc {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 25px;
        max-width: 300px;
    }
    .action-btn { padding: 10px 25px; font-size: 13px; }
    .action-btn-alt {
        padding: 10px 25px;
        font-size: 13px;
        border: 1px solid var(--border);
        color: #fff;
        background: rgba(255,255,255,0.02);
    }

    @media (max-width: 768px) {
        .action-card { flex-direction: column; text-align: center; gap: 20px; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bondaa\resources\views/dashboard.blade.php ENDPATH**/ ?>