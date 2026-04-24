@extends('layouts.app')

@section('title', 'Riwayat Transaksi | Varap Japanese')

@section('content')
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
                    <th style="padding: 20px; font-weight: 700; font-size: 13px; color: var(--text-muted); text-transform: uppercase; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $trx)
                <tr style="border-bottom: 1px solid var(--border); transition: var(--transition); background: white;">
                    <td style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 14px;">
                        #{{ str_pad($index + 1 + ($transactions->currentPage() - 1) * $transactions->perPage(), 3, '0', STR_PAD_LEFT) }}
                    </td>
                    <td style="padding: 20px;">
                        <div style="font-weight: 700; color: var(--text-main); font-size: 15px; margin-bottom: 4px;">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</div>
                        <div style="font-size: 12px; color: var(--primary); font-weight: 600;">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('H:i') }} WIB</div>
                    </td>
                    <td style="padding: 20px;">
                        <span style="background: #f1f5f9; padding: 6px 10px; border-radius: 8px; font-family: monospace; font-size: 13px; color: var(--text-muted); border: 1px solid var(--border);">
                            {{ $trx->transaction_number }}
                        </span>
                    </td>
                    <td style="padding: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800;">
                                {{ substr($trx->user->name ?? 'K', 0, 1) }}
                            </div>
                            <span style="font-size: 14px; font-weight: 600; color: var(--text-main);">{{ $trx->user->name ?? 'Tidak Diketahui' }}</span>
                        </div>
                    </td>
                    <td style="padding: 20px; text-align: right; font-weight: 800; color: var(--primary); font-size: 15px;">
                        Rp {{ number_format($trx->total, 0, ',', '.') }}
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <a href="{{ route('transactions.print', $trx->id) }}" target="_blank"
                           style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; background: linear-gradient(135deg, #2563eb, #1e40af); color: white; border-radius: 10px; font-size: 12px; font-weight: 700; text-decoration: none; transition: all 0.2s ease; box-shadow: 0 3px 10px rgba(37,99,235,0.25);"
                           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(37,99,235,0.4)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 3px 10px rgba(37,99,235,0.25)'">
                            🖨️ Cetak Struk
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 60px 20px;">
                        <div style="font-size: 48px; margin-bottom: 15px; opacity: 0.2;">📜</div>
                        <h3 style="color: var(--text-main); font-size: 18px; margin-bottom: 8px;">Tidak Ada Transaksi</h3>
                        <p style="color: var(--text-muted); font-size: 14px;">Belum ada transaksi yang tercatat dalam sistem.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 25px;">
    {{ $transactions->links() ?? '' }}
</div>
@endsection
