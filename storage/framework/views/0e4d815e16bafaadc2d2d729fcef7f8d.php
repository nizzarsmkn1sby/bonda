<?php $__env->startSection('title', 'ARAP POS | Solusi Kasir Profesional'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height: 90vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 40px;">
    
    <div style="background: var(--primary-light); border: 1px solid var(--primary); padding: 8px 24px; border-radius: 100px; font-size: 13px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 40px; box-shadow: 0 0 20px var(--primary-glow);">
        Sistem Manajemen Terintegrasi v2.0
    </div>

    <h1 style="font-size: clamp(40px, 10vw, 90px); font-weight: 800; line-height: 1.1; margin-bottom: 24px; letter-spacing: -3px; color: #fff;">
        Kelola Bisnis Anda <br>
        <span style="background: linear-gradient(to right, #6366f1, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Lebih Presisi.</span>
    </h1>

    <p style="color: var(--text-muted); font-size: 18px; margin-bottom: 50px; max-width: 650px; line-height: 1.6; font-weight: 500;">
        Optimalkan operasional perdagangan Anda dengan sistem kasir modern yang dirancang untuk kecepatan, keamanan, dan analisis data real-time.
    </p>
    
    <div style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center;">
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary" style="padding: 20px 50px; font-size: 16px;">
                Buka Panel Kontrol ⚡
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary" style="padding: 20px 50px; font-size: 16px;">
                Masuk ke Sistem 🚀
            </a>
            <a href="#" class="btn" style="border: 1px solid var(--border); color: var(--text-main); padding: 20px 50px; font-size: 16px; background: rgba(255,255,255,0.02);">
                Pelajari Fitur
            </a>
        <?php endif; ?>
    </div>

    <div style="margin-top: 100px; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; width: 100%; max-width: 1000px;">
        <div class="card" style="text-align: left; padding: 30px;">
            <div style="font-size: 32px; margin-bottom: 20px;">📊</div>
            <h4 style="font-weight: 800; font-size: 16px; color: #fff; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Analisis Real-Time</h4>
            <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">Pantau performa penjualan dan inventaris Anda secara instan dari mana saja.</p>
        </div>
        <div class="card" style="text-align: left; padding: 30px;">
            <div style="font-size: 32px; margin-bottom: 20px;">🛡️</div>
            <h4 style="font-weight: 800; font-size: 16px; color: #fff; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Keamanan Data</h4>
            <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">Proteksi data transaksi dengan enkripsi tingkat tinggi dan sistem cadangan otomatis.</p>
        </div>
        <div class="card" style="text-align: left; padding: 30px;">
            <div style="font-size: 32px; margin-bottom: 20px;">⚡</div>
            <h4 style="font-weight: 800; font-size: 16px; color: #fff; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Efisiensi Tinggi</h4>
            <p style="font-size: 14px; color: var(--text-muted); line-height: 1.5;">Proses transaksi lebih cepat dengan antarmuka yang intuitif dan responsif.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ARAP\resources\views/welcome.blade.php ENDPATH**/ ?>