@extends('layouts.app')
@section('title', $product->exists ? 'Edit Barang' : 'Tambah Barang')
@section('content')
  <h1 class="h2 mb-4">{{ $product->exists ? 'Edit Barang' : 'Tambah Barang' }}</h1>
  <div class="card card-lg" style="max-width:640px"><div class="card-body p-6">
    <form method="POST" action="{{ $product->exists ? route('owner.produk.update', $product) : route('owner.produk.store') }}">
      @csrf
      @if ($product->exists) @method('PUT') @endif

      @foreach ([
        ['name', 'Nama barang', 'text'],
        ['jenis', 'Jenis barang', 'text'],
        ['satuan', 'Satuan (meter / batang / ukuran ...)', 'text'],
        ['price', 'Harga umum (tidak langganan)', 'number'],
        ['price_langganan', 'Harga pelanggan langganan', 'number'],
      ] as [$field, $label, $type])
        <div class="mb-3">
          <label class="form-label">{{ $label }}</label>
          <input type="{{ $type }}" name="{{ $field }}" value="{{ old($field, $product->$field) }}"
            class="form-control @error($field) is-invalid @enderror" required>
          @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      @endforeach

      <button class="btn btn-primary" type="submit">Simpan</button>
      <a href="{{ route('owner.produk.index') }}" class="btn btn-light">Batal</a>
    </form>
  </div></div>
@endsection
