@php
  $role = auth()->user()->role;
  $menus = [
    'pelanggan' => [
      ['Dashboard', 'ti-layout-dashboard', route('pelanggan.dashboard')],
      ['Produk', 'ti-shopping-bag', '#!'],
     ['Buat Pesanan', 'ti-receipt', route('pelanggan.pesanan.create')],
      ['Profil', 'ti-user-circle', '#!'],
    ],
    'kasir' => [
      ['Dashboard', 'ti-layout-dashboard', route('kasir.dashboard')],
      ['Transaksi Baru', 'ti-cash-register', '#!'],
      ['Daftar Produk', 'ti-packages', '#!'],
      ['Riwayat Transaksi', 'ti-history', '#!'],
    ],
    'owner' => [
      ['Dashboard', 'ti-layout-dashboard', route('owner.dashboard')],
      ['Laporan Penjualan', 'ti-chart-bar', '#!'],
      ['Kelola Produk', 'ti-packages', route('owner.produk.index')],
      ['Kelola Kasir', 'ti-users', '#!'],
      ['Data Pelanggan', 'ti-user-circle', route('owner.pelanggan.index')],
    ],
  ][$role];
@endphp
<ul class="navbar-nav flex-column">
  <li class="nav-item">
    <div class="nav-heading text-capitalize">Menu {{ $role }}</div>
    <hr class="mx-5 nav-line mb-1" />
  </li>
  @foreach ($menus as [$label, $icon, $url])
    <li class="nav-item">
      <a class="nav-link" href="{{ $url }}">
        <span class="nav-icon"><i class="ti {{ $icon }} fs-5"></i></span>
        <span class="text">{{ $label }}</span>
      </a>
    </li>
  @endforeach
</ul>
