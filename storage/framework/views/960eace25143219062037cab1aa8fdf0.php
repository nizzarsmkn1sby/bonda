<?php $__env->startSection('title', 'Master Kategori | BONDAA'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div class="page-title">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--text-main);">Master Kategori</h1>
        <p style="color: var(--text-muted);">Kelola kategori produk untuk pengorganisasian yang lebih baik.</p>
    </div>
    <button class="btn btn-primary" onclick="openModal('add')">
        <span>➕</span> Tambah Kategori
    </button>
</div>

<?php if(session('error')): ?>
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 20px; border-left: 5px solid #ef4444;">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div style="font-weight: 700; color: var(--text-main);"><?php echo e($category->name); ?></div>
                    </td>
                    <td>
                        <div style="color: var(--text-muted); font-size: 13px;"><?php echo e($category->description ?: '-'); ?></div>
                    </td>
                    <td>
                        <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            <?php echo e($category->products_count); ?> Produk
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; justify-content: flex-end; gap: 8px;">
                            <button class="btn" style="padding: 6px 12px; background: #f1f5f9; color: var(--text-main);" 
                                onclick="openModal('edit', <?php echo e(json_encode($category)); ?>)">
                                ✏️
                            </button>
                            <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn" style="padding: 6px 12px; background: #fee2e2; color: #ef4444;">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                        Belum ada kategori yang ditambahkan.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="categoryModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-content" style="background: white; width: 450px; border-radius: 24px; padding: 30px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); position: relative;">
        <button onclick="closeModal()" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 20px; cursor: pointer; color: var(--text-muted);">✕</button>
        
        <h2 id="modalTitle" style="margin-bottom: 20px; font-weight: 800; color: var(--text-main);">Tambah Kategori</h2>
        
        <form id="categoryForm" action="<?php echo e(route('categories.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div id="methodField"></div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Nama Kategori</label>
                <input type="text" name="name" id="catName" required style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid var(--border); outline: none; transition: var(--transition);" placeholder="Contoh: Makanan Berat">
            </div>
            
            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;">Deskripsi (Opsional)</label>
                <textarea name="description" id="catDesc" rows="3" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid var(--border); outline: none; transition: var(--transition);" placeholder="Keterangan kategori..."></textarea>
            </div>
            
            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="closeModal()" class="btn" style="flex: 1; background: #f1f5f9; color: var(--text-main);">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(type, data = null) {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const catName = document.getElementById('catName');
        const catDesc = document.getElementById('catDesc');
        
        if (type === 'add') {
            title.innerText = 'Tambah Kategori';
            form.action = "<?php echo e(route('categories.store')); ?>";
            methodField.innerHTML = '';
            catName.value = '';
            catDesc.value = '';
        } else {
            title.innerText = 'Edit Kategori';
            form.action = `/categories/${data.id}`;
            methodField.innerHTML = '<?php echo method_field("PUT"); ?>';
            catName.value = data.name;
            catDesc.value = data.description || '';
        }
        
        modal.style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('categoryModal').style.display = 'none';
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('categoryModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

<style>
    #catName:focus, #catDesc:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bonda-main\bonda-main\resources\views/categories/index.blade.php ENDPATH**/ ?>