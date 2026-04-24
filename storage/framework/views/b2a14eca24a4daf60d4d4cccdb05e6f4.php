<?php $__env->startSection('title', 'Riwayat Transaksi | Varap Japanese'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-title">
        <h1>Riwayat Transaksi</h1>
        <p>Arsip semua catatan transaksi operasional yang telah diproses</p>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--border);">
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; width: 60px; text-align: center;">No</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Waktu Transaksi</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">ID Referensi</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Kasir</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; text-align: right;">Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid var(--border); transition: var(--transition);">
                    <td style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 14px;">
                        #<?php echo e(str_pad($index + 1 + ($transactions->currentPage() - 1) * $transactions->perPage(), 3, '0', STR_PAD_LEFT)); ?>

                    </td>
                    <td style="padding: 20px;">
                        <div style="font-weight: 700; color: #fff; font-size: 15px; margin-bottom: 4px;"><?php echo e(\Carbon\Carbon::parse($trx->transaction_date)->format('d M Y')); ?></div>
                        <div style="font-size: 12px; color: var(--primary); font-weight: 600;"><?php echo e(\Carbon\Carbon::parse($trx->transaction_date)->format('H:i')); ?> WIB</div>
                    </td>
                    <td style="padding: 20px;">
                        <span style="background: rgba(0,0,0,0.2); padding: 6px 10px; border-radius: 8px; font-family: monospace; font-size: 13px; color: var(--text-muted); border: 1px solid var(--border);">
                            <?php echo e($trx->transaction_number); ?>

                        </span>
                    </td>
                    <td style="padding: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800;">
                                <?php echo e(substr($trx->user->name ?? 'K', 0, 1)); ?>

                            </div>
                            <span style="font-size: 14px; font-weight: 600; color: #fff;"><?php echo e($trx->user->name ?? 'Tidak Diketahui'); ?></span>
                        </div>
                    </td>
                    <td style="padding: 20px; text-align: right; font-weight: 800; color: var(--primary); font-size: 15px;">
                        Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 60px 20px;">
                        <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.2;">📜</div>
                        <h3 style="color: #fff; font-size: 18px; margin-bottom: 8px;">Tidak Ada Transaksi</h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Belum ada transaksi yang tercatat dalam sistem.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 25px;">
    <?php echo e($transactions->links() ?? ''); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bondaa\resources\views/transactions/index.blade.php ENDPATH**/ ?>