<?php $__env->startSection('title', 'Terminal Kasir | BONDAA'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header" style="margin-bottom: 30px;">
    <div class="page-title">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 5px;">Terminal Penjualan</h1>
        <p style="color: var(--text-muted); font-size: 14px;"><?php echo e(date('l, d F Y')); ?> | Sesi Kasir Aktif 🚀</p>
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

        <!-- Category Filters -->
        <div class="category-tabs" style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 15px; margin-bottom: 20px;">
            <a href="<?php echo e(route('pos.index')); ?>" 
               class="category-tab <?php echo e(!request('category_id') ? 'active' : ''); ?>"
               style="padding: 10px 20px; border-radius: 100px; background: <?php echo e(!request('category_id') ? 'var(--primary)' : 'white'); ?>; color: <?php echo e(!request('category_id') ? 'white' : 'var(--text-main)'); ?>; text-decoration: none; font-size: 13px; font-weight: 700; border: 1px solid <?php echo e(!request('category_id') ? 'var(--primary)' : 'var(--border)'); ?>; white-space: nowrap; transition: var(--transition);">
               Semua Menu
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('pos.index', ['category_id' => $cat->id])); ?>" 
               class="category-tab <?php echo e(request('category_id') == $cat->id ? 'active' : ''); ?>"
               style="padding: 10px 20px; border-radius: 100px; background: <?php echo e(request('category_id') == $cat->id ? 'var(--primary)' : 'white'); ?>; color: <?php echo e(request('category_id') == $cat->id ? 'white' : 'var(--text-main)'); ?>; text-decoration: none; font-size: 13px; font-weight: 700; border: 1px solid <?php echo e(request('category_id') == $cat->id ? 'var(--primary)' : 'var(--border)'); ?>; white-space: nowrap; transition: var(--transition);">
               <?php echo e($cat->name); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="product-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="product-card" onclick="tambahKeKeranjang(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>)">
                <div class="product-icon-wrapper">
                    <span class="product-icon">🍱</span>
                    <span class="cat-badge" style="position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.9); padding: 4px 8px; border-radius: 8px; font-size: 10px; font-weight: 800; color: var(--primary); backdrop-filter: blur(4px);">
                        <?php echo e($product->category->name ?? 'Uncategorized'); ?>

                    </span>
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
        
        <div class="pagination-wrapper" style="margin-top: 30px;">
            <?php echo e($products->links() ?? ''); ?>

        </div>
    </div>

    <!-- Bagian Kanan: Keranjang Belanja -->
    <div class="cart-section">
        <div class="cart-card">
            <div class="cart-header">
                <div class="cart-header-left">
                    <span class="cart-icon">🛒</span>
                    <h3 class="cart-title">Pesanan Aktif</h3>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button type="button" onclick="hapusSemua()" style="background: none; border: none; color: #ef4444; font-size: 11px; font-weight: 700; cursor: pointer; padding: 4px 8px; border-radius: 6px; transition: var(--transition);">KOSONGKAN</button>
                    <span class="cart-count" id="cartCount">0 Item</span>
                </div>
            </div>

            <div class="cart-body">
                <div id="cartItemsList" class="cart-items-list">
                    <!-- Items will be injected here by JS -->
                    <div class="cart-empty-state" id="rowKosong">
                        <div class="empty-cart-illustration">🌸</div>
                        <h4>Keranjang Kosong</h4>
                        <p>Pilih menu lezat di samping untuk memulai pesanan.</p>
                    </div>
                </div>
            </div>

            <div class="cart-footer">
                <div class="summary-details">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal</span>
                        <span class="summary-value" id="labelTotal">0</span>
                    </div>
                </div>
                
                <div class="payment-section">
                    <div class="payment-input-group">
                        <label>Jumlah Bayar</label>
                        <div class="input-with-symbol" onclick="document.getElementById('bayar').focus()">
                            <span class="symbol">Rp</span>
                            <input type="text" id="bayar" class="payment-input" placeholder="0" 
                                   inputmode="numeric" 
                                   oninput="this.value = this.value.replace(/[^0-9]/g, ''); hitungKembalian();">
                        </div>
                        <div style="margin-top: 10px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                            <button type="button" onclick="setUangPas()" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid var(--primary); background: rgba(37, 99, 235, 0.05); color: var(--primary); cursor: pointer; transition: var(--transition);">Uang Pas</button>
                            <button type="button" onclick="tambahUang(10000)" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: var(--text-main); cursor: pointer; transition: var(--transition);">+10rb</button>
                            <button type="button" onclick="tambahUang(20000)" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: var(--text-main); cursor: pointer; transition: var(--transition);">+20rb</button>
                            <button type="button" onclick="tambahUang(50000)" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: var(--text-main); cursor: pointer; transition: var(--transition);">+50rb</button>
                            <button type="button" onclick="tambahUang(100000)" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid #cbd5e1; background: white; color: var(--text-main); cursor: pointer; transition: var(--transition);">+100rb</button>
                            <button type="button" onclick="resetBayar()" style="padding: 10px; font-size: 11px; font-weight: 700; border-radius: 10px; border: 1px solid #fee2e2; background: #fef2f2; color: #ef4444; cursor: pointer; transition: var(--transition);">Reset</button>
                        </div>
                    </div>
                    
                    <div class="change-display">
                        <span class="change-label">Kembalian</span>
                        <span class="change-value" id="labelKembalian">Rp 0</span>
                    </div>
                </div>

                <button type="button" class="checkout-button" onclick="submitTransaksi()">
                    <span>Konfirmasi Pesanan</span>
                    <span class="btn-icon">⛩️</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .cashier-layout {
        grid-template-columns: 1fr 450px;
        gap: 30px;
        align-items: start;
    }

    /* Catalog Styling */
    .search-box {
        margin-bottom: 25px;
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
        width: 100%;
        padding-left: 55px;
        padding-right: 50px;
        height: 60px;
        border-radius: 16px;
        background: white;
        border: 1px solid var(--border);
        font-size: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: var(--transition);
    }
    .search-input-wrapper .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    .btn-reset {
        position: absolute;
        right: 15px;
        background: #f1f5f9;
        color: var(--text-muted);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        max-height: calc(100vh - 250px);
        overflow-y: auto;
        padding-right: 5px;
    }

    .product-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 15px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        gap: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }
    .product-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
    }
    .product-icon-wrapper {
        width: 100%;
        height: 140px;
        background: #f8fafc;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        transition: var(--transition);
    }
    .product-card:hover .product-icon-wrapper {
        background: rgba(37, 99, 235, 0.05);
    }
    .product-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-main);
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
        font-size: 14px;
    }
    .product-stock {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        background: #f1f5f9;
        padding: 3px 8px;
        border-radius: 6px;
    }

    /* --- PREMIUM CART STYLING --- */
    .cart-section {
        position: sticky;
        top: 100px;
    }
    .cart-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        height: calc(100vh - 120px);
        min-height: 600px;
        overflow: hidden;
        border-top: 6px solid var(--primary);
    }
    .cart-header {
        flex-shrink: 0;
        padding: 25px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafafa;
    }
    .cart-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .cart-icon {
        font-size: 24px;
    }
    .cart-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: var(--text-main);
    }
    .cart-count {
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
        background: rgba(37, 99, 235, 0.08);
        padding: 6px 14px;
        border-radius: 100px;
    }

    .cart-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: white;
        min-height: 0; /* Important for flex-grow with overflow */
    }
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .cart-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        transition: var(--transition);
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .cart-item-img {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        border: 1px solid #f1f5f9;
    }
    .cart-item-info {
        flex: 1;
    }
    .cart-item-name {
        font-weight: 700;
        font-size: 14px;
        color: var(--text-main);
        margin-bottom: 2px;
    }
    .cart-item-price {
        font-size: 12px;
        color: var(--primary);
        font-weight: 600;
    }
    .cart-item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        gap: 10px;
    }
    .cart-qty-input {
        width: 60px !important;
        height: 32px !important;
        padding: 0 !important;
        text-align: center;
        font-size: 14px !important;
        font-weight: 800 !important;
        border-radius: 8px !important;
        border: 1px solid var(--border) !important;
        background: white !important;
    }
    .btn-remove {
        color: #94a3b8;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: var(--transition);
    }
    .btn-remove:hover {
        color: #ef4444;
        transform: scale(1.1);
    }

    .cart-footer {
        flex-shrink: 0;
        padding: 20px 25px 25px 25px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
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
        color: var(--text-main);
    }

    .payment-section {
        background: white;
        padding: 15px;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .payment-input-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .input-with-symbol {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-with-symbol .symbol {
        position: absolute;
        left: 15px;
        font-weight: 800;
        color: var(--text-muted);
    }
    .payment-input {
        width: 100%;
        height: 45px;
        padding: 0 15px 0 40px;
        font-size: 20px;
        font-weight: 800;
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        color: var(--text-main);
        text-align: right;
        transition: var(--transition);
    }
    .payment-input:focus {
        outline: none;
        border-color: var(--primary);
        background: #fdfdfd;
    }
    .change-display {
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px dashed #f1f5f9;
    }
    .change-label {
        font-size: 13px;
        font-weight: 700;
        color: #10b981;
    }
    .change-value {
        font-size: 18px;
        font-weight: 800;
        color: #10b981;
    }

    .checkout-button {
        width: 100%;
        height: 55px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: var(--transition);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
    }
    .checkout-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
    }
    .checkout-button:active {
        transform: translateY(-1px);
    }

    /* States */
    .cart-empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-cart-illustration {
        font-size: 60px;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    .cart-empty-state h4 {
        font-size: 18px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .cart-empty-state p {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    @media (max-width: 1024px) {
        .cashier-layout { grid-template-columns: 1fr; }
        .cart-section { position: relative; top: 0; }
        .cart-card { height: auto; max-height: none; }
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

    function hapusSemua() {
        if(keranjang.length > 0 && confirm("Kosongkan semua pesanan?")) {
            keranjang = [];
            renderKeranjang();
        }
    }

    function renderKeranjang() {
        var container = document.getElementById("cartItemsList");
        container.innerHTML = '';
        totalBelanja = 0;
        var totalQty = 0;

        if(keranjang.length === 0) {
            container.innerHTML = `
                <div class="cart-empty-state" id="rowKosong">
                    <div class="empty-cart-illustration">🌸</div>
                    <h4>Keranjang Kosong</h4>
                    <p>Pilih menu lezat di samping untuk memulai pesanan.</p>
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
                <div class="cart-item-img">🍱</div>
                <div class="cart-item-info">
                    <div class="cart-item-name">${keranjang[i].nama}</div>
                    <div class="cart-item-price">Rp ${formatRupiah(keranjang[i].harga)}</div>
                </div>
                <div class="cart-item-actions">
                    <button type="button" class="btn-remove" onclick="hapusItem(${i})" title="Hapus">✕</button>
                    <input type="number" value="${keranjang[i].qty}" min="1" class="form-control cart-qty-input" 
                           onchange="ubahQty(${i}, this.value)">
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
        
        var checkoutBtn = document.querySelector(".checkout-button");
        if(bayar >= totalBelanja && totalBelanja > 0) {
            kembalian = bayar - totalBelanja;
            checkoutBtn.style.opacity = "1";
            checkoutBtn.style.transform = "scale(1)";
        } else {
            checkoutBtn.style.opacity = "0.7";
            checkoutBtn.style.transform = "scale(0.98)";
        }
        
        document.getElementById("labelKembalian").innerText = "Rp " + formatRupiah(kembalian);
    }

    function setUangPas() {
        document.getElementById("bayar").value = totalBelanja;
        hitungKembalian();
    }

    function tambahUang(nominal) {
        var current = parseInt(document.getElementById("bayar").value) || 0;
        document.getElementById("bayar").value = current + nominal;
        hitungKembalian();
    }

    function resetBayar() {
        document.getElementById("bayar").value = '';
        hitungKembalian();
    }

    // Listener Keyboard untuk mempermudah eksekusi
    document.getElementById("bayar").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            submitTransaksi();
        }
    });

    // Fokus ke input bayar saat menekan tombol /
    document.addEventListener("keydown", function(event) {
        if (event.key === "/" && document.activeElement.tagName !== "INPUT") {
            event.preventDefault();
            document.getElementById("bayar").focus();
        }
    });

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

        // Visual feedback: Loading state
        var btn = document.querySelector(".checkout-button");
        var originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span>Memproses...</span> <span class="spinner">⏳</span>';
        btn.style.opacity = "0.7";

        var data = {
            items: keranjang.map(function(item) {
                return { product_id: item.id, quantity: item.qty };
            }),
            payment_method: "cash",
            payment_amount: bayar,
            _token: '<?php echo e(csrf_token()); ?>'
        };

        fetch("<?php echo e(route('transactions.store')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.message || "Gagal memproses transaksi") });
            }
            return response.json();
        })
        .then(result => {
            if(result.success) {
                // 1. Alert success dulu (sebelum buka tab baru agar tidak hang)
                alert("\u2705 Transaksi Berhasil!\nKembalian: Rp " + formatRupiah(bayar - totalBelanja));

                // 2. Reset keranjang & UI secara manual (TANPA reload halaman)
                keranjang = [];
                totalBelanja = 0;
                document.getElementById("bayar").value = '';
                document.getElementById("labelKembalian").innerText = "Rp 0";
                renderKeranjang();

                // 3. Reset tombol bayar
                btn.disabled = false;
                btn.innerHTML = originalContent;
                btn.style.opacity = "0.7"; // Akan kembali normal saat ada item

                // 4. Buka struk SETELAH UI direset (bukan sebelumnya)
                var printUrl = "<?php echo e(url('transactions')); ?>/" + result.transaction_id + "/print";
                window.open(printUrl, '_blank');

                // 5. Fokus ke input bayar untuk transaksi berikutnya
                document.getElementById("bayar").focus();
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi Kesalahan: " + error.message);
            // Only reset if NOT success (since success reloads the page)
            btn.disabled = false;
            btn.innerHTML = originalContent;
            btn.style.opacity = "1";
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bonda-main\bonda-main\resources\views/cashier/index.blade.php ENDPATH**/ ?>