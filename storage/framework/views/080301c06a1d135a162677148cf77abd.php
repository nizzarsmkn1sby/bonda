<?php $__env->startSection('title', 'Terminal Kasir | BONDAA'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header" style="margin-bottom: 30px;">
    <div class="page-title">
        <h1>Terminal Penjualan</h1>
        <p><?php echo e(date('l, d F Y')); ?> | Sistem Operasional Aktif</p>
    </div>
</div>

<div class="grid cashier-layout">
    
    <!-- Bagian Kiri: Katalog Produk -->
    <div class="catalog-section">
        <div class="search-box">
            <form action="<?php echo e(route('pos.index')); ?>" method="GET">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" class="form-control" placeholder="Cari menu atau kode produk..." value="<?php echo e(request('search')); ?>">
                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('pos.index')); ?>" class="btn-reset">✕</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="product-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="product-card" onclick="tambahKeKeranjang(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>)">
                <div class="product-icon-wrapper">
                    <span class="product-icon">🍱</span>
                </div>
                <div class="product-info">
                    <h4 class="product-name"><?php echo e($product->name); ?></h4>
                    <div class="product-meta">
                        <span class="product-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                        <span class="product-stock <?php echo e($product->stock_quantity <= $product->min_stock_alert ? 'low-stock' : ''); ?>">
                            Stok: <?php echo e($product->stock_quantity); ?>

                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <div class="empty-icon">🔎</div>
                <p>Produk tidak ditemukan</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="pagination-wrapper">
            <?php echo e($products->links() ?? ''); ?>

        </div>
    </div>

    <!-- Bagian Kanan: Keranjang Belanja -->
    <div class="cart-section card">
        <div class="cart-header">
            <h3 class="cart-title">
                <span class="icon">🏮</span> Pesanan Aktif
            </h3>
            <span class="cart-count" id="cartCount">0 Item</span>
        </div>

        <div class="cart-body">
            <div id="cartItemsList" class="cart-items-list">
                <!-- Items will be injected here by JS -->
                <div class="cart-empty-state" id="rowKosong">
                    <div class="empty-cart-icon">🌸</div>
                    <p>Pilih menu untuk memulai</p>
                </div>
            </div>
        </div>

        <div class="cart-footer">
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value" id="labelTotal">0</span>
            </div>
            
            <div class="payment-form">
                <div class="input-group">
                    <label>Jumlah Bayar (Rp)</label>
                    <input type="number" id="bayar" class="form-control payment-input" placeholder="0" onkeyup="hitungKembalian()">
                </div>
                
                <div class="change-box">
                    <span class="change-label">Kembalian</span>
                    <span class="change-value" id="labelKembalian">0</span>
                </div>
            </div>

            <button type="button" class="btn btn-primary checkout-btn" onclick="submitTransaksi()">
                Konfirmasi Pesanan ⛩️
            </button>
        </div>
    </div>
</div>

<style>
    .cashier-layout {
        grid-template-columns: 1fr 420px;
        gap: 30px;
        align-items: start;
    }

    /* Catalog Styling */
    .search-box {
        margin-bottom: 30px;
    }
    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-icon {
        position: absolute;
        left: 20px;
        color: var(--text-muted);
        font-size: 18px;
    }
    .search-input-wrapper .form-control {
        padding-left: 55px;
        padding-right: 50px;
        height: 60px;
        border-radius: 16px;
        background: rgba(30, 30, 30, 0.4);
        border: 1px solid var(--border);
        font-size: 16px;
    }
    .btn-reset {
        position: absolute;
        right: 15px;
        background: rgba(255,255,255,0.05);
        color: var(--text-muted);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
        transition: var(--transition);
    }
    .btn-reset:hover {
        background: var(--primary);
        color: white;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        max-height: calc(100vh - 250px);
        overflow-y: auto;
        padding-right: 10px;
    }

    .product-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 20px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        gap: 15px;
        position: relative;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 10px 25px rgba(229, 57, 53, 0.15);
    }
    .product-icon-wrapper {
        width: 100%;
        height: 120px;
        background: rgba(0,0,0,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        transition: var(--transition);
    }
    .product-card:hover .product-icon-wrapper {
        background: var(--primary-light);
        transform: scale(1.05);
    }
    .product-name {
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product-price {
        color: var(--primary);
        font-weight: 800;
        font-size: 15px;
    }
    .product-stock {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        background: rgba(255,255,255,0.03);
        padding: 4px 10px;
        border-radius: 8px;
    }
    .product-stock.low-stock {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }

    /* Cart Styling */
    .cart-section {
        position: sticky;
        top: 100px;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 140px);
        padding: 0;
        overflow: hidden;
        border-top: 4px solid var(--primary);
    }
    .cart-header {
        padding: 25px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255,255,255,0.01);
    }
    .cart-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .cart-count {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        background: rgba(255,255,255,0.05);
        padding: 4px 12px;
        border-radius: 100px;
    }

    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
    }
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .cart-item {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed var(--border);
    }
    .cart-item-info {
        flex: 1;
    }
    .cart-item-name {
        font-weight: 700;
        font-size: 14px;
        color: #fff;
        margin-bottom: 4px;
    }
    .cart-item-price {
        font-size: 12px;
        color: var(--text-muted);
    }
    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cart-qty-input {
        width: 50px !important;
        height: 32px !important;
        padding: 0 !important;
        text-align: center;
        font-size: 13px !important;
        font-weight: 800 !important;
        border-radius: 8px !important;
    }
    .btn-remove {
        color: #ef4444;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        opacity: 0.6;
        transition: var(--transition);
    }
    .btn-remove:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    .cart-footer {
        padding: 25px;
        background: rgba(0,0,0,0.3);
        border-top: 1px solid var(--border);
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .summary-label {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .summary-value {
        font-size: 28px;
        font-weight: 900;
        color: var(--primary);
    }

    .payment-form {
        background: rgba(0,0,0,0.2);
        padding: 20px;
        border-radius: 16px;
        margin-bottom: 25px;
        border: 1px solid var(--border);
    }
    .payment-input {
        height: 50px !important;
        font-size: 20px !important;
        font-weight: 800 !important;
        text-align: right;
        margin-top: 8px;
        border-radius: 12px !important;
    }
    .change-box {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }
    .change-label {
        font-size: 13px;
        font-weight: 700;
        color: #10b981;
    }
    .change-value {
        font-size: 20px;
        font-weight: 800;
        color: #10b981;
    }

    .checkout-btn {
        width: 100%;
        height: 65px;
        font-size: 16px;
        border-radius: 18px;
        box-shadow: 0 10px 20px rgba(229, 57, 53, 0.2);
    }

    /* States */
    .cart-empty-state {
        text-align: center;
        padding: 80px 20px;
        opacity: 0.5;
    }
    .empty-cart-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }
    .empty-state {
        grid-column: span 3;
        text-align: center;
        padding: 80px;
        background: rgba(255,255,255,0.02);
        border-radius: 20px;
        border: 2px dashed var(--border);
    }
    .empty-icon {
        font-size: 50px;
        margin-bottom: 15px;
        opacity: 0.3;
    }

    @media (max-width: 1024px) {
        .cashier-layout {
            grid-template-columns: 1fr;
        }
        .cart-section {
            position: relative;
            top: 0;
            height: auto;
            max-height: none;
        }
    }
</style>

<script>
    var keranjang = [];
    var totalBelanja = 0;

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function tambahKeKeranjang(id, nama, harga) {
        var ada = false;
        for(var i=0; i<keranjang.length; i++) {
            if(keranjang[i].id == id) {
                keranjang[i].qty++;
                ada = true;
                break;
            }
        }
        if(!ada) {
            keranjang.push({id: id, nama: nama, harga: harga, qty: 1});
        }
        renderKeranjang();
    }

    function ubahQty(index, val) {
        var newQty = parseInt(val);
        if(newQty > 0) {
            keranjang[index].qty = newQty;
        } else {
            keranjang[index].qty = 1;
        }
        renderKeranjang();
    }

    function hapusItem(index) {
        keranjang.splice(index, 1);
        renderKeranjang();
    }

    function renderKeranjang() {
        var container = document.getElementById("cartItemsList");
        container.innerHTML = '';
        totalBelanja = 0;
        var totalQty = 0;

        if(keranjang.length === 0) {
            container.innerHTML = `
                <div class="cart-empty-state" id="rowKosong">
                    <div class="empty-cart-icon">🌸</div>
                    <p>Pilih menu untuk memulai</p>
                </div>
            `;
            document.getElementById("labelTotal").innerText = "0";
            document.getElementById("cartCount").innerText = "0 Item";
            hitungKembalian();
            return;
        }

        for(var i=0; i<keranjang.length; i++) {
            var itemTotal = keranjang[i].harga * keranjang[i].qty;
            totalBelanja += itemTotal;
            totalQty += keranjang[i].qty;

            var div = document.createElement('div');
            div.className = 'cart-item';
            div.innerHTML = `
                <div class="cart-item-info">
                    <div class="cart-item-name">${keranjang[i].nama}</div>
                    <div class="cart-item-price">@ Rp ${formatRupiah(keranjang[i].harga)}</div>
                </div>
                <div class="cart-item-actions">
                    <input type="number" value="${keranjang[i].qty}" min="1" class="form-control cart-qty-input" 
                           onchange="ubahQty(${i}, this.value)">
                    <button type="button" class="btn-remove" onclick="hapusItem(${i})">🗑️</button>
                </div>
            `;
            container.appendChild(div);
        }

        document.getElementById("labelTotal").innerText = formatRupiah(totalBelanja);
        document.getElementById("cartCount").innerText = totalQty + " Item";
        hitungKembalian();
    }

    function hitungKembalian() {
        var bayar = parseInt(document.getElementById("bayar").value) || 0;
        var kembalian = 0;
        
        if(bayar >= totalBelanja && totalBelanja > 0) {
            kembalian = bayar - totalBelanja;
        }
        
        document.getElementById("labelKembalian").innerText = formatRupiah(kembalian);
    }

    function submitTransaksi() {
        if(keranjang.length == 0) {
            alert("Keranjang masih kosong.");
            return;
        }
        
        var bayar = parseInt(document.getElementById("bayar").value) || 0;
        if(bayar < totalBelanja) {
            alert("Jumlah pembayaran tidak mencukupi.");
            return;
        }

        if(!confirm("Konfirmasi dan proses transaksi ini?")) return;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo e(route('transactions.store')); ?>", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if(xhr.status == 200) {
                    alert("Transaksi Berhasil!\nKembalian: Rp " + formatRupiah(bayar - totalBelanja));
                    window.location.reload();
                } else {
                    alert("Gagal memproses transaksi. Silakan coba lagi.");
                }
            }
        };

        var data = {
            items: keranjang.map(function(item) {
                return { product_id: item.id, quantity: item.qty };
            }),
            payment_method: "cash",
            payment_amount: bayar,
            _token: '<?php echo e(csrf_token()); ?>'
        };

        xhr.send(JSON.stringify(data));
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bondaa\resources\views/cashier/index.blade.php ENDPATH**/ ?>