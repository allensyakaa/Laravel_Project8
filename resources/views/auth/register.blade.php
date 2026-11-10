<!DOCTYPE html>
<html lang="id">
  <head>
    @include('partials.head.head-meta')
    <title>Daftar Pelanggan | {{ config('app.name') }}</title>
    @include('partials.head.head-links')
  </head>
  <body>
    <main class="d-flex flex-column justify-content-center min-vh-100 py-6">
      <section>
        <div class="container">
          <div class="row mb-6">
            <div class="col-xl-4 offset-xl-4 col-md-12 col-12 text-center">
              <a href="{{ route('home') }}" class="fs-2 fw-bold d-flex align-items-center gap-2 justify-content-center mb-6">
                <img src="{{ asset('assets/images/brand/logo/logo-icon.svg') }}" alt="" />
                <span>{{ config('app.name') }}</span>
              </a>
              <h1 class="mb-1">Daftar Pelanggan</h1>
              <p class="mb-0">Sudah punya akun? <a href="{{ route('login', 'pelanggan') }}" class="text-primary">Login</a></p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 col-12">
              <div class="card card-lg">
                <div class="card-body p-6">
                  <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama lengkap</label>
                      <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" required autofocus />
                      @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required />
                      @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password (min. 8 karakter)</label>
                      <div class="password-field position-relative">
                        <input type="password" name="password" id="password"
                          class="form-control fakePassword @error('password') is-invalid @enderror" required />
                        <span><i class="ti ti-eye-off passwordToggler"></i></span>
                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                      </div>
                    </div>
                    <div class="mb-4">
                      <label for="password_confirmation" class="form-label">Ulangi password</label>
                      <div class="password-field position-relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                          class="form-control fakePassword" required />
                        <span><i class="ti ti-eye-off passwordToggler"></i></span>
                      </div>
                    </div>
                    <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                  </form>
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
