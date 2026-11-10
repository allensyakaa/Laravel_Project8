@extends('layouts.app')
@section('title', 'Detail Pelanggan')
@section('content')
  <a href="{{ route('owner.pelanggan.index') }}" class="text-secondary">&larr; Kembali</a>
  <h1 class="h2 mt-2 mb-1">
    {{ $pelanggan->name }}
    @if ($pelanggan->is_langganan)<span class="badge bg-warning text-dark fs-6">⭐ Langganan</span>@endif
  </h1>
  <p class="text-secondary mb-6">{{ $pelanggan->email }}</p>

  <div class="card card-lg"><div class="card-body">
    <h5 class="mb-4">Daftar Belanja dan Status Pesanan</h5>
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead><tr><th>Tanggal</th><th>Barang</th><th>Jumlah</th><th>Total</th><th>Tujuan</th><th>Pembayaran</th><th>Status</th><th></th></tr></thead>
        <tbody>
          @forelse ($orders as $o)
            <tr>
              <td>{{ $o->created_at->format('d/m/Y') }}</td>
              <td>{{ $o->product->name }}</td>
              <td>{{ $o->jumlah }} {{ $o->product->satuan }}</td>
              <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
              <td>{{ $o->wilayah === 'luar_kota' ? 'Luar kota' : 'Dalam kota' }}</td>
              <td>
                <span class="text-capitalize">{{ str_replace('_', ' ', $o->metode_pembayaran) }}</span>
                @if ($o->bukti_pembayaran)
                  <br><a href="{{ asset('storage/'.$o->bukti_pembayaran) }}" target="_blank" class="small">Lihat bukti</a>
                @endif
              </td>
              <td><span class="badge {{ \App\Models\Order::STATUS[$o->status][1] }}">{{ \App\Models\Order::STATUS[$o->status][0] }}</span></td>
              <td class="text-end">
                @if ($o->status === 'dalam_pesanan')
                  <form method="POST" action="{{ route('owner.pesanan.terima', $o) }}">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-primary">Terima pesanan</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center text-secondary py-5">Pelanggan ini belum pernah memesan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div></div>
@endsection
