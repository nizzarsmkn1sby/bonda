@extends('layouts.app')

@section('title', isset($product) ? 'Ubah Produk | BONDAA' : 'Tambah Produk | BONDAA')

@section('content')
<div class="page-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-start;">
    <div class="page-title">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--text-main); margin-bottom: 8px;">
            {{ isset($product) ? 'Ubah Data Produk' : 'Tambah Produk Baru' }}
        </h1>
        <p style="color: var(--text-muted); font-size: 15px;">
            Masukkan spesifikasi detail, stok, dan harga barang untuk inventaris toko Anda.
        </p>
    </div>
    <a href="{{ route('products.index') }}" class="btn" style="background: white; border: 1px solid var(--border); color: var(--text-muted); border-radius: 12px; padding: 12px 20px;">
        <span>←</span> Kembali
    </a>
</div>

<div class="card" style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: none; overflow: hidden;">
    <div style="background: linear-gradient(90deg, var(--primary), var(--primary-dark)); padding: 4px;"></div>
    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data" style="padding: 40px;">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        
        <div class="form-section" style="margin-bottom: 40px;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--primary); margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <span style="width: 32px; height: 32px; background: rgba(37, 99, 235, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">📝</span>
                Informasi Dasar
            </h3>
            
            <div class="grid grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Nama Produk <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}" required 
                           placeholder="Misal: Kopi Susu Aren"
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px; transition: var(--transition);">
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Kategori Produk <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="display: flex; gap: 10px;">
                        <select name="category_id" id="categorySelect" class="form-control" required 
                                style="flex: 1; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px; cursor: pointer; appearance: none;">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (old('category_id', isset($product) ? $product->category_id : '') == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" onclick="showCategoryModal()" class="btn" style="background: rgba(37, 99, 235, 0.1); color: var(--primary); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 20px; font-weight: 800;">
                            +
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-top: 25px;">
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        SKU (Unit Penjualan)
                    </label>
                    <input type="text" name="sku" class="form-control" value="{{ old('sku', isset($product) ? $product->sku : '') }}" 
                           placeholder="Otomatis jika kosong"
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px;">
                </div>
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Kode Barcode
                    </label>
                    <input type="text" name="barcode" class="form-control" value="{{ old('barcode', isset($product) ? $product->barcode : '') }}" 
                           placeholder="Scan atau ketik barcode"
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px;">
                </div>
            </div>
        </div>

        <div class="form-section" style="margin-bottom: 40px;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--primary); margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <span style="width: 32px; height: 32px; background: rgba(37, 99, 235, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">💰</span>
                Harga & Stok
            </h3>
            
            <div class="grid grid-3" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 25px;">
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Harga Jual (Rp) <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" required 
                           placeholder="0"
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px; font-weight: 700; color: var(--primary);">
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Stok Saat Ini <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', isset($product) ? $product->stock_quantity : '0') }}" required
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px;">
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Minimum Stok Alert <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="number" name="min_stock_alert" class="form-control" value="{{ old('min_stock_alert', isset($product) ? $product->min_stock_alert : '5') }}" required
                           style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px;">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--primary); margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <span style="width: 32px; height: 32px; background: rgba(37, 99, 235, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">🖼️</span>
                Media & Detail
            </h3>
            
            <div class="grid grid-2" style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px;">
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Deskripsi Singkat
                    </label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Berikan deskripsi atau komposisi produk..."
                              style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px; resize: none;">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">
                        Foto Produk
                    </label>
                    <div style="border: 2px dashed var(--border); border-radius: 12px; padding: 20px; text-align: center; background: #f8fafc; height: 145px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <input type="file" name="image" id="productImage" accept="image/*" style="display: none;">
                        <label for="productImage" style="cursor: pointer;">
                            <div style="font-size: 24px; margin-bottom: 8px;">📸</div>
                            <div style="font-size: 13px; color: var(--primary); font-weight: 600;">Klik untuk Upload</div>
                            <div style="font-size: 11px; color: var(--text-muted);">PNG, JPG (Max. 2MB)</div>
                        </label>
                    </div>
                    @if(isset($product) && $product->image_url)
                        <div style="margin-top: 10px; font-size: 12px; color: var(--primary); background: rgba(37, 99, 235, 0.05); padding: 8px 12px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span>🔗</span> {{ basename($product->image_url) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-top: 50px; border-top: 1px solid var(--border); padding-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
            <button type="reset" class="btn" style="background: #f1f5f9; color: var(--text-main); padding: 14px 25px; border-radius: 12px;">
                Reset Form
            </button>
            <button type="submit" class="btn btn-primary" style="padding: 14px 40px; border-radius: 12px; font-size: 15px; font-weight: 700;">
                {{ isset($product) ? 'Simpan Perubahan' : 'Simpan Produk Baru' }}
            </button>
        </div>
    </form>
</div>

<!-- Modal Kategori Baru -->
<div id="categoryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div class="card" style="width: 450px; padding: 0; border-radius: 20px; overflow: hidden; position: relative;">
        <div style="background: var(--primary); color: white; padding: 25px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700;">Tambah Kategori Baru</h3>
            <button onclick="hideCategoryModal()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <div style="padding: 30px;">
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">Nama Kategori</label>
                <input type="text" id="newCategoryName" class="form-control" placeholder="Misal: Minuman Dingin"
                       style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px;">
            </div>
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 10px; color: var(--text-main);">Deskripsi (Opsional)</label>
                <textarea id="newCategoryDesc" class="form-control" rows="3" placeholder="Keterangan singkat..."
                          style="width: 100%; padding: 14px 18px; border-radius: 12px; border: 1px solid var(--border); background: #f8fafc; font-size: 15px; resize: none;"></textarea>
            </div>
            <button type="button" onclick="saveCategory()" class="btn btn-primary" style="width: 100%; padding: 15px; border-radius: 12px; font-weight: 700;">
                Simpan Kategori ✨
            </button>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        outline: none;
        border-color: var(--primary) !important;
        background: white !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
</style>

<script>
    function showCategoryModal() {
        document.getElementById('categoryModal').style.display = 'flex';
    }

    function hideCategoryModal() {
        document.getElementById('categoryModal').style.display = 'none';
        document.getElementById('newCategoryName').value = '';
        document.getElementById('newCategoryDesc').value = '';
    }

    function saveCategory() {
        const name = document.getElementById('newCategoryName').value;
        const desc = document.getElementById('newCategoryDesc').value;

        if (!name) {
            alert('Nama kategori harus diisi!');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('categories.store') }}', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Tambahkan ke dropdown
                        const select = document.getElementById('categorySelect');
                        const option = document.createElement('option');
                        option.value = response.category.id;
                        option.text = response.category.name;
                        option.selected = true;
                        select.add(option);

                        hideCategoryModal();
                        alert('Kategori berhasil ditambahkan!');
                    }
                } else {
                    const response = JSON.parse(xhr.responseText);
                    alert('Gagal: ' + (response.message || 'Terjadi kesalahan'));
                }
            }
        };

        xhr.send(JSON.stringify({
            name: name,
            description: desc
        }));
    }
</script>
@endsection
