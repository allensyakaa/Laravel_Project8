@extends('layouts.app')
@section('title', 'Kelola Produk')
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-6">
    <h1 class="h2 mb-0">Kelola Produk</h1>
    <a href="{{ route('owner.produk.create') }}" class="btn btn-primary">+ Tambah Barang</a>
  </div>
  <div class="card card-lg"><div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead><tr><th>Nama</th><th>Jenis</th><th>Satuan</th><th>Harga Umum</th><th>Harga Langganan</th><th></th></tr></thead>
        <tbody>
          @forelse ($products as $p)
            <tr>
              <td>{{ $p->name }}</td>
              <td>{{ $p->jenis }}</td>
              <td>{{ $p->satuan }}</td>
              <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($p->price_langganan, 0, ',', '.') }}</td>
              <td class="text-end">
                <a href="{{ route('owner.produk.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('owner.produk.destroy', $p) }}" class="d-inline"
                      onsubmit="return confirm('Hapus barang ini?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-secondary py-5">Belum ada barang.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div></div>
@endsection
