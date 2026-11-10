@extends('layouts.app')
@section('title', 'Buat Pesanan')
@section('content')
  <h1 class="h2 mb-4">Form Pemesanan</h1>
  <div class="card card-lg" style="max-width:720px">
    <div class="card-body p-6">
      <form method="POST" action="{{ route('pelanggan.pesanan.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Barang</label>
          <select name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
            <option value="">-- pilih barang --</option>
            @foreach ($products as $p)
              <option value="{{ $p->id }}" @selected(old('product_id', $selected) == $p->id)>
                {{ $p->name }} - Rp {{ number_format($p->priceFor(auth()->user()), 0, ',', '.') }}/{{ $p->satuan }}
              </option>
            @endforeach
          </select>
          @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="jumlah" min="1" value="{{ old('jumlah', 1) }}"
            class="form-control @error('jumlah') is-invalid @enderror" required>
          @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat pengiriman</label>
          <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
          @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
        <label class="form-label">Tujuan pengiriman</label>
        <select name="wilayah" class="form-select @error('wilayah') is-invalid @enderror" required>
            <option value="dalam_kota" @selected(old('wilayah') == 'dalam_kota')>Dalam kota</option>
            <option value="luar_kota" @selected(old('wilayah') == 'luar_kota')>Luar kota</option>
        </select>
        @error('wilayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

        <div class="mb-3">
          <label class="form-label">Metode pembayaran</label>
          <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror" required>
            <option value="">-- pilih --</option>
            <option value="transfer_bank" @selected(old('metode_pembayaran') == 'transfer_bank')>Transfer Bank</option>
            <option value="e_wallet" @selected(old('metode_pembayaran') == 'e_wallet')>E-Wallet</option>
            <option value="cod" @selected(old('metode_pembayaran') == 'cod')>Bayar di Tempat (COD)</option>
          </select>
          @error('metode_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
          <label class="form-label">Bukti pembayaran <small class="text-secondary">(foto, maks 2 MB, tidak perlu untuk COD)</small></label>
          <input type="file" name="bukti_pembayaran" accept="image/*"
            class="form-control @error('bukti_pembayaran') is-invalid @enderror">
          @error('bukti_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-light">Batal</a>
      </form>
    </div>
  </div>
@endsection
