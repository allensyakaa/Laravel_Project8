@php
  $labels = ['pelanggan' => 'Pelanggan', 'kasir' => 'Kasir', 'owner' => 'Owner'];
@endphp
<!DOCTYPE html>
<html lang="id">
  <head>
    @include('partials.head.head-meta')
    <title>Login {{ $labels[$role] }} | {{ config('app.name') }}</title>
    @include('partials.head.head-links')
  </head>
  <body>
    <main class="d-flex flex-column justify-content-center vh-100">
      <section>
        <div class="container">
          <div class="row mb-8">
            <div class="col-xl-4 offset-xl-4 col-md-12 col-12">
              <div class="text-center">
                <a href="{{ route('home') }}" class="fs-2 fw-bold d-flex align-items-center gap-2 justify-content-center mb-6">
                  <img src="{{ asset('assets/images/brand/logo/logo-icon.svg') }}" alt="" />
                  <span>{{ config('app.name') }}</span>
                </a>
                <h1 class="mb-1">Login {{ $labels[$role] }}</h1>
                @if ($role === 'pelanggan')
                  <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar di sini</a></p>
                @else
                  <p class="mb-0">Akun {{ strtolower($labels[$role]) }} dibuat oleh pemilik toko.</p>
                @endif
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-12">
              <div class="card card-lg mb-6">
                <div class="card-body p-6">
                  <form method="POST" action="{{ route('login.attempt', $role) }}" class="mb-4">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required autofocus />
                      @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <div class="password-field position-relative">
                        <input type="password" name="password" id="password"
                          class="form-control fakePassword @error('password') is-invalid @enderror" required />
                        <span><i class="ti ti-eye-off passwordToggler"></i></span>
                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                      </div>
                    </div>
                    <div class="mb-4 form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                      <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                  </form>
                  <div class="text-center small">
                    Masuk sebagai:
                    @foreach ($labels as $r => $label)
                      @if ($r !== $role)<a href="{{ route('login', $r) }}" class="text-primary ms-2">{{ $label }}</a>@endif
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    @include('partials.scripts')
    <script src="{{ asset('assets/js/vendors/password.js') }}"></script>
  </body>
</html>
