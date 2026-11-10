<div class="card card-lg">
  <div class="card-body">
    <h5 class="mb-4">{{ $title }}</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr><th>#</th><th>Nama Produk</th><th class="text-end">Harga</th></tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->name }}</td>
              <td class="text-end">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr><td colspan="3" class="text-center text-secondary py-5">Belum ada produk.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
