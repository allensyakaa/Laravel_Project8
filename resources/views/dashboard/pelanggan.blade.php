@extends('layouts.app')
@section('title', 'Dashboard Pelanggan')
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-6">
    <div>
      <h1 class="h2 mb-1">Halo, {{ auth()->user()->name }} 👋</h1>
      @if (auth()->user()->is_langganan)
  <span class="badge bg-warning text-dark">⭐ Pelanggan Langganan</span>
@endif
      <p class="text-secondary mb-0">Pilih barang dan buat pesanan.</p>
    </div>
    <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary">+ Buat Pesanan</a>
  </div>

  {{-- 1. Daftar barang --}}
  <div class="card card-lg mb-6">
    <div class="card-body">
      <h5 class="mb-4">Daftar Barang</h5>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead><tr><th>Nama Barang</th><th>Jenis</th><th>Harga</th><th></th></tr></thead>
          <tbody>
            @forelse ($products as $p)
              <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->jenis }}</td>
                <td>Rp {{ number_format($p->priceFor(auth()->user()), 0, ',', '.') }} / {{ $p->satuan }}</td>
                <td class="text-end">
                  <a href="{{ route('pelanggan.pesanan.create', ['product' => $p->id]) }}" class="btn btn-sm btn-outline-primary">Pesan</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center text-secondary py-5">Belum ada barang.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- 2. Status pemesanan --}}
  <div class="card card-lg mb-6">
    <div class="card-body">
      <h5 class="mb-4">Status Pemesanan</h5>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead><tr><th>Tanggal</th><th>Barang</th><th>Jumlah</th><th>Total</th><th>Status</th></tr></thead>
          <tbody>
            @forelse ($pesananAktif as $o)
              <tr>
                <td>{{ $o->created_at->format('d/m/Y') }}</td>
                <td>{{ $o->product->name }}</td>
                <td>{{ $o->jumlah }} {{ $o->product->satuan }}</td>
                <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                <td><span class="badge {{ \App\Models\Order::STATUS[$o->status][1] }}">{{ \App\Models\Order::STATUS[$o->status][0] }}</span></td>
              </tr>
            @empty
              <tr><td colspan="5" class="text-center text-secondary py-5">Tidak ada pesanan yang sedang berjalan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- 3. Riwayat pemesanan --}}
  <div class="card card-lg">
    <div class="card-body">
      <h5 class="mb-4">Riwayat Pemesanan</h5>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead><tr><th>Tanggal</th><th>Barang</th><th>Jumlah</th><th>Total</th><th>Pembayaran</th></tr></thead>
          <tbody>
            @forelse ($riwayat as $o)
              <tr>
                <td>{{ $o->created_at->format('d/m/Y') }}</td>
                <td>{{ $o->product->name }}</td>
                <td>{{ $o->jumlah }} {{ $o->product->satuan }}</td>
                <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                <td class="text-capitalize">{{ str_replace('_', ' ', $o->metode_pembayaran) }}</td>
              </tr>
            @empty
              <tr><td colspan="5" class="text-center text-secondary py-5">Belum ada riwayat pesanan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
