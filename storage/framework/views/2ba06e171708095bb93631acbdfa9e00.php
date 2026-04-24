<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #<?php echo e($transaction->transaction_number); ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
            font-size: 12px;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .item-row {
            margin-bottom: 10px;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
        }
        @media print {
            body { width: 100%; margin: 0; padding: 0; }
            .no-print { display: none; }
        }
        .btn-print {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <button class="btn-print no-print" onclick="window.print()">CETAK STRUK</button>

    <div class="header">
        <h2>BONDAA.</h2>
        <p>Solusi Kasir Pintar & Modern</p>
        <p><?php echo e(date('d/m/Y H:i', strtotime($transaction->transaction_date))); ?></p>
    </div>

    <div class="info-row">
        <span>No: <?php echo e($transaction->transaction_number); ?></span>
        <span>Kasir: <?php echo e($transaction->user->name); ?></span>
    </div>

    <div class="divider"></div>

    <?php $__currentLoopData = $transaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item-row">
        <div><?php echo e($item->product->name); ?></div>
        <div class="item-details">
            <span><?php echo e($item->quantity); ?> x <?php echo e(number_format($item->unit_price, 0, ',', '.')); ?></span>
            <span><?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></span>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="divider"></div>

    <div class="info-row">
        <span>Subtotal:</span>
        <span><?php echo e(number_format($transaction->subtotal, 0, ',', '.')); ?></span>
    </div>
    <?php if($transaction->discount > 0): ?>
    <div class="info-row">
        <span>Diskon:</span>
        <span>-<?php echo e(number_format($transaction->discount, 0, ',', '.')); ?></span>
    </div>
    <?php endif; ?>
    <?php if($transaction->tax > 0): ?>
    <div class="info-row">
        <span>Pajak:</span>
        <span><?php echo e(number_format($transaction->tax, 0, ',', '.')); ?></span>
    </div>
    <?php endif; ?>

    <div class="info-row" style="font-weight: bold; font-size: 14px; margin-top: 5px;">
        <span>TOTAL:</span>
        <span>Rp <?php echo e(number_format($transaction->total, 0, ',', '.')); ?></span>
    </div>

    <div class="divider"></div>

    <div class="info-row">
        <span>Bayar:</span>
        <span><?php echo e(number_format($transaction->payment_amount, 0, ',', '.')); ?></span>
    </div>
    <div class="info-row">
        <span>Kembali:</span>
        <span><?php echo e(number_format($transaction->change_amount, 0, ',', '.')); ?></span>
    </div>

    <div class="footer">
        <p>Terima Kasih Atas Kunjungan Anda</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
        <p>--- BONDAA POS ---</p>
    </div>

    <script>
        // Auto print when loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\bonda-main\bonda-main\resources\views/transactions/print.blade.php ENDPATH**/ ?>