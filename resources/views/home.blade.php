<!DOCTYPE html>
<html lang="id">
  <head>
    @include('partials.head.head-meta')
    <title>Masuk | {{ config('app.name') }}</title>
    @include('partials.head.head-links')
  </head>
  <body>
    <main class="d-flex flex-column justify-content-center min-vh-100 py-8">
      <div class="container">
        <div class="text-center mb-8">
          <a href="{{ route('home') }}" class="fs-2 fw-bold d-flex align-items-center gap-2 justify-content-center mb-4">
            <img src="{{ asset('assets/images/brand/logo/logo-icon.svg') }}" alt="" />
            <span>{{ config('app.name') }}</span>
          </a>
          <h1 class="mb-1">Selamat datang</h1>
          <p class="mb-0">Pilih masuk sebagai siapa.</p>
        </div>
        <div class="row justify-content-center g-4">
          @foreach ([
            ['pelanggan', 'Pelanggan', 'ti-user', 'Lihat produk dan pesanan kamu.'],
            ['kasir', 'Kasir', 'ti-cash-register', 'Layani transaksi penjualan.'],
            ['owner', 'Owner', 'ti-building-store', 'Pantau toko, produk, dan pengguna.'],
          ] as [$role, $label, $icon, $desc])
            <div class="col-lg-3 col-md-4 col-sm-6">
              <a href="{{ route('login', $role) }}" class="card card-lg h-100 text-decoration-none text-center">
                <div class="card-body py-6">
                  <div class="mb-3"><i class="ti {{ $icon }} fs-1 text-primary"></i></div>
                  <h4 class="mb-1">{{ $label }}</h4>
                  <p class="text-secondary mb-0 small">{{ $desc }}</p>
                  <span class="btn btn-primary mt-4">Masuk sebagai {{ $label }}</span>
                </div>
              </a>
            </div>
          @endforeach
        </div>
        <p class="text-center mt-6 mb-0">Belum punya akun pelanggan? <a href="{{ route('register') }}" class="text-primary">Daftar di sini</a></p>
      </div>
    </main>
    @include('partials.scripts')
  </body>
</html>
