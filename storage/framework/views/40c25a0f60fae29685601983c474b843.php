<?php $__env->startSection('title', isset($product) ? 'Ubah Produk | Varap Japanese' : 'Tambah Produk | Varap Japanese'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="page-title">
        <h1><?php echo e(isset($product) ? 'Ubah Data Produk' : 'Tambah Produk Baru'); ?></h1>
        <p>Masukkan spesifikasi detail, stok, dan harga barang</p>
    </div>
    <div>
        <a href="<?php echo e(route('products.index')); ?>" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid var(--border); color: var(--text-muted);">
            Batal & Kembali
        </a>
    </div>
</div>

<div class="card" style="max-width: 900px;">
    <form action="<?php echo e(isset($product) ? route('products.update', $product->id) : route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($product)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        
        <div class="grid grid-2" style="margin-bottom: 24px;">
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Nama Produk <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', isset($product) ? $product->name : '')); ?>" required placeholder="Contoh: Kopi Susu Aren"
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Nomor Seri / SKU</label>
                <input type="text" name="sku" class="form-control" value="<?php echo e(old('sku', isset($product) ? $product->sku : '')); ?>" placeholder="Otomatis jika dikosongkan"
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Kode Barcode</label>
                <input type="text" name="barcode" class="form-control" value="<?php echo e(old('barcode', isset($product) ? $product->barcode : '')); ?>" placeholder="Scan atau ketik barcode"
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
        </div>

        <div class="grid grid-2" style="margin-bottom: 24px;">
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Kategori Produk <span style="color: #ef4444;">*</span></label>
                <select name="category_id" class="form-control" required 
                        style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px; cursor: pointer;">
                    <option value="" style="color: #000;">-- PILIH KATEGORI --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e((old('category_id', isset($product) ? $product->category_id : '') == $cat->id) ? 'selected' : ''); ?> style="color: #000;">
                            <?php echo e(strtoupper($cat->name)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Harga Jual (Rp) <span style="color: #ef4444;">*</span></label>
                <input type="number" name="price" step="0.01" class="form-control" value="<?php echo e(old('price', isset($product) ? $product->price : '')); ?>" required placeholder="0"
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Harga Modal (Rp)</label>
                <input type="number" name="cost_price" step="0.01" class="form-control" value="<?php echo e(old('cost_price', isset($product) ? $product->cost_price : '')); ?>" placeholder="0"
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
        </div>

        <div class="grid grid-2" style="margin-bottom: 24px;">
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Stok Awal <span style="color: #ef4444;">*</span></label>
                <input type="number" name="stock_quantity" class="form-control" value="<?php echo e(old('stock_quantity', isset($product) ? $product->stock_quantity : '0')); ?>" required
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Batas Minimum Stok <span style="color: #ef4444;">*</span></label>
                <input type="number" name="min_stock_alert" class="form-control" value="<?php echo e(old('min_stock_alert', isset($product) ? $product->min_stock_alert : '5')); ?>" required
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;">
            </div>
        </div>
        
        <div class="grid grid-2" style="margin-bottom: 10px;">
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Deskripsi Produk</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Keterangan tambahan..."
                          style="background: rgba(0,0,0,0.2); border-color: var(--border); color: #fff; border-radius: 12px;"><?php echo e(old('description', isset($product) ? $product->description : '')); ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label" style="color: #fff; font-size: 13px;">Foto Produk (.jpg / .png)</label>
                <div style="position: relative;">
                    <input type="file" name="image" class="form-control" accept="image/*" 
                           style="background: rgba(0,0,0,0.2); border-color: var(--border); color: var(--text-muted); border-radius: 12px; padding: 10px;">
                    <?php if(isset($product) && $product->image_url): ?>
                        <div style="margin-top: 12px; font-size: 12px; color: var(--primary); background: var(--primary-light); display: inline-block; padding: 4px 10px; border-radius: 6px;">
                            Saat ini: <?php echo e(basename($product->image_url)); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; border-top: 1px solid var(--border); padding-top: 30px; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary" style="padding: 16px 40px; font-size: 15px;">
                <?php echo e(isset($product) ? 'Simpan Perubahan ✨' : 'Simpan Produk Baru 🚀'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bondaa\resources\views/products/form.blade.php ENDPATH**/ ?>