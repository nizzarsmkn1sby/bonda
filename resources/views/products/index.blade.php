@extends('layouts.app')

@section('title', 'Manajemen Produk | Varap Japanese')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Kelola Produk</h1>
        <p>Manajemen data inventaris dan harga barang</p>
    </div>
    <div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Tambah Produk Baru
        </a>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--border);">
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; width: 60px; text-align: center;">ID</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Informasi Produk</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">SKU</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; text-align: right;">Harga Jual</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; text-align: center;">Stok</th>
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $prod)
                <tr style="border-bottom: 1px solid var(--border); transition: var(--transition); background: white;">
                    <td style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 14px;">
                        #{{ str_pad($index + 1 + ($products->currentPage() - 1) * $products->perPage(), 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td style="padding: 20px;">
                        <div style="font-weight: 700; color: var(--text-main); font-size: 15px; margin-bottom: 4px;">{{ $prod->name }}</div>
                        <div style="font-size: 12px; color: var(--primary); font-weight: 600; background: rgba(37, 99, 235, 0.1); display: inline-block; padding: 2px 8px; border-radius: 6px;">{{ strtoupper($prod->category->name ?? 'UMUM') }}</div>
                    </td>
                    <td style="padding: 20px;">
                        <span style="background: #f1f5f9; padding: 6px 10px; border-radius: 8px; font-family: monospace; font-size: 13px; color: var(--text-muted); border: 1px solid var(--border);">
                            {{ $prod->sku ?: '-' }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: right; font-weight: 700; color: var(--text-main); font-size: 15px;">
                        Rp {{ number_format($prod->price, 0, ',', '.') }}
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <span style="display: inline-block; padding: 6px 12px; border-radius: 8px; font-size: 13px; font-weight: 700; 
                            background: {{ $prod->stock_quantity <= $prod->min_stock_alert ? 'rgba(239, 68, 68, 0.1)' : 'rgba(16, 185, 129, 0.1)' }}; 
                            color: {{ $prod->stock_quantity <= $prod->min_stock_alert ? '#ef4444' : '#10b981' }};
                            border: 1px solid {{ $prod->stock_quantity <= $prod->min_stock_alert ? 'rgba(239, 68, 68, 0.2)' : 'rgba(16, 185, 129, 0.2)' }};">
                            {{ $prod->stock_quantity }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="{{ route('products.edit', $prod->id) }}" class="btn" style="padding: 8px 16px; font-size: 13px; background: rgba(99, 102, 241, 0.1); color: var(--primary); border-radius: 10px;">
                                Ubah
                            </a>
                            
                            <form action="{{ route('products.destroy', $prod->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="padding: 8px 16px; font-size: 13px; background: rgba(239, 68, 68, 0.1); color: #ef4444; border-radius: 10px;" onclick="return confirm('Anda yakin ingin menghapus produk ini dari sistem?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 60px 20px;">
                        <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.2;">📦</div>
                        <h3 style="color: var(--text-main); font-size: 18px; margin-bottom: 8px;">Data Kosong</h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Belum ada data produk yang ditambahkan ke dalam sistem.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 25px;">
    {{ $products->links() ?? '' }}
</div>
@endsection
