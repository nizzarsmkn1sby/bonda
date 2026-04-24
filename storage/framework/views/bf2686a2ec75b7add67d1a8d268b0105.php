<?php $__env->startSection('title', 'Terminal Kasir | ARAP POS'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header" style="margin-bottom: 30px;">
    <div class="page-title">
        <h1>Terminal Penjualan</h1>
        <p><?php echo e(date('l, d F Y')); ?> | Sistem Operasional Aktif</p>
    </div>
</div>

<div class="grid cashier-layout">
    
    <!-- Bagian Kiri: Katalog Produk -->
    <div>
        <div class="card" style="padding: 20px; margin-bottom: 30px; background: rgba(31, 41, 55, 0.2);">
            <form action="<?php echo e(route('pos.index')); ?>" method="GET" style="display: flex; gap: 15px;">
                <div style="flex: 1; position: relative;">
                    <span style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted);">🔍</span>
                    <input type="text" name="search" class="form-control" placeholder="Cari produk berdasarkan nama atau SKU..." value="<?php echo e(request('search')); ?>" 
                           style="padding-left: 45px; border-radius: 14px; background: rgba(15, 23, 42, 0.6); border-color: var(--border); height: 50px;">
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 0 30px; height: 50px;">Cari</button>
                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('pos.index')); ?>" class="btn" style="height: 50px; background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="grid grid-3" style="gap: 20px; max-height: 65vh; overflow-y: auto; padding-right: 10px;">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card" style="padding: 20px; display: flex; flex-direction: column; align-items: center; text-align: center; cursor: pointer; border: 1px solid var(--border);" 
                 onclick="tambahKeKeranjang(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>)">
                
                <div style="width: 60px; height: 60px; background: var(--primary-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 15px;">📦</div>
                <h4 style="font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 8px; line-height: 1.4;"><?php echo e($product->name); ?></h4>
                <div style="font-size: 16px; color: var(--primary); font-weight: 800; margin-bottom: 10px;">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></div>
                <div style="font-size: 12px; color: var(--text-muted); font-weight: 600; background: rgba(255,255,255,0.03); padding: 4px 12px; border-radius: 8px;">Stok: <?php echo e($product->stock_quantity); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column: span 3; text-align: center; padding: 60px; background: var(--card-bg); border-radius: 24px; border: 1px dashed var(--border);">
                <div style="font-size: 40px; margin-bottom: 15px; opacity: 0.3;">🔎</div>
                <p style="color: var(--text-muted); font-weight: 600;">Produk tidak ditemukan dalam sistem.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card cart-container">
        <div style="padding: 25px; border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.02);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                <span style="color: var(--primary);">🛒</span> Daftar Belanja
            </h3>
        </div>

        <div style="flex: 1; overflow-y: auto; padding: 15px;">
            <table style="width: 100%; border-collapse: collapse;" id="tabelKeranjang">
                <tbody>
                    <tr id="rowKosong">
                        <td style="text-align: center; padding: 60px 20px;">
                            <div style="font-size: 40px; margin-bottom: 15px; opacity: 0.2;">🍱</div>
                            <p style="color: var(--text-muted); font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Keranjang Kosong</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="padding: 25px; background: rgba(0,0,0,0.2); border-top: 1px solid var(--border);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <span style="color: var(--text-muted); font-weight: 700; font-size: 13px; text-transform: uppercase;">Total Pembayaran</span>
                <strong style="font-size: 26px; color: var(--primary); font-weight: 800;">Rp <span id="labelTotal">0</span></strong>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Diterima (Rp)</label>
                <input type="number" id="bayar" class="form-control" placeholder="0" onkeyup="hitungKembalian()" 
                       style="height: 55px; font-size: 22px; font-weight: 800; text-align: right; border-radius: 14px; background: rgba(0,0,0,0.3); border-color: var(--border); color: #fff; width: 100%; padding: 0 20px;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 15px; background: rgba(16, 185, 129, 0.05); border-radius: 14px; border: 1px solid rgba(16, 185, 129, 0.1);">
                <span style="color: #10b981; font-weight: 700; font-size: 13px; text-transform: uppercase;">Kembalian</span>
                <strong style="font-size: 22px; color: #10b981; font-weight: 800;">Rp <span id="labelKembalian">0</span></strong>
            </div>

            <button type="button" class="btn btn-primary" style="width: 100%; height: 60px; font-size: 16px; border-radius: 16px; text-transform: uppercase; letter-spacing: 1px;" onclick="submitTransaksi()">
                Konfirmasi Transaksi ✨
            </button>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-light);
        outline: none;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    .cashier-layout {
        grid-template-columns: 1fr 400px;
        align-items: start;
        gap: 30px;
    }
    
    .cart-container {
        position: sticky;
        top: 40px;
        padding: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: calc(100vh - 80px);
    }
    
    @media (max-width: 1024px) {
        .cashier-layout {
            grid-template-columns: 1fr;
        }
        .cart-container {
            position: relative;
            top: 0;
            height: auto;
            max-height: 800px;
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
        var tbody = document.getElementById("tabelKeranjang").getElementsByTagName('tbody')[0];
        tbody.innerHTML = '';
        totalBelanja = 0;

        if(keranjang.length === 0) {
            tbody.innerHTML = '<tr id="rowKosong"><td style="text-align: center; padding: 60px 20px;"><div style="font-size: 40px; margin-bottom: 15px; opacity: 0.2;">🍱</div><p style="color: var(--text-muted); font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Keranjang Kosong</p></td></tr>';
            document.getElementById("labelTotal").innerText = "0";
            hitungKembalian();
            return;
        }

        for(var i=0; i<keranjang.length; i++) {
            var itemTotal = keranjang[i].harga * keranjang[i].qty;
            totalBelanja += itemTotal;

            var tr = document.createElement('tr');
            tr.style.borderBottom = "1px solid var(--border)";
            tr.innerHTML = `
                <td style="padding: 15px 5px;">
                    <div style="font-weight: 700; font-size: 14px; color: #fff; margin-bottom: 4px;">${keranjang[i].nama}</div>
                    <div style="font-size: 12px; color: var(--text-muted);">@ Rp ${formatRupiah(keranjang[i].harga)}</div>
                </td>
                <td style="width: 80px; padding: 15px 5px;">
                    <input type="number" value="${keranjang[i].qty}" min="1" class="form-control" 
                           style="height: 35px; text-align: center; font-size: 13px; font-weight: 700; border-radius: 8px; background: rgba(255,255,255,0.05);" 
                           onchange="ubahQty(${i}, this.value)">
                </td>
                <td style="text-align: right; padding: 15px 5px;">
                    <div style="font-weight: 800; color: var(--primary); font-size: 14px;">${formatRupiah(itemTotal)}</div>
                    <button type="button" style="background: none; border: none; color: #ef4444; font-size: 11px; font-weight: 700; cursor: pointer; padding: 4px 0;" onclick="hapusItem(${i})">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        }

        document.getElementById("labelTotal").innerText = formatRupiah(totalBelanja);
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\ARAP\resources\views/cashier/index.blade.php ENDPATH**/ ?>