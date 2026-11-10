@extends('layouts.app')
@section('title', 'Data Pelanggan')
@section('content')
  <h1 class="h2 mb-6">Data Pelanggan</h1>
  <div class="card card-lg"><div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead><tr><th>Nama</th><th>Email</th><th>Title</th><th>Jumlah Pesanan</th><th></th></tr></thead>
        <tbody>
          @forelse ($pelanggan as $u)
            <tr>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>
                @if ($u->is_langganan)<span class="badge bg-warning text-dark">⭐ Langganan</span>
                @else<span class="text-secondary">Biasa</span>@endif
              </td>
              <td>{{ $u->orders_count }}</td>
              <td class="text-end">
                <a href="{{ route('owner.pelanggan.show', $u) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                <form method="POST" action="{{ route('owner.pelanggan.langganan', $u) }}" class="d-inline">
                  @csrf @method('PATCH')
                  <button class="btn btn-sm btn-outline-secondary">{{ $u->is_langganan ? 'Cabut langganan' : 'Jadikan langganan' }}</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center text-secondary py-5">Belum ada pelanggan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div></div>
@endsection
