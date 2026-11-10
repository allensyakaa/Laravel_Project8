<!DOCTYPE html>
<html lang="id">
  <head>
    @include('partials.head.head-meta')
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    @include('partials.head.head-links')
  </head>
  <body>
    <div>
      {{-- Sidebar (desktop) --}}
      <div id="miniSidebar">
        <div class="brand-logo">
          <a class="d-none d-md-flex align-items-center gap-2" href="{{ route(auth()->user()->dashboardRoute()) }}">
            <img src="{{ asset('assets/images/brand/logo/logo-icon.svg') }}" alt="" />
            <span class="fw-bold fs-4 site-logo-text">{{ config('app.name') }}</span>
          </a>
        </div>
        @include('partials.role-menu')
      </div>

      {{-- Sidebar (mobile) --}}
      <div class="offcanvasNav offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <a class="d-flex align-items-center gap-2" href="{{ route(auth()->user()->dashboardRoute()) }}">
            <img src="{{ asset('assets/images/brand/logo/logo-icon.svg') }}" alt="" />
            <span class="fw-bold fs-4 site-logo-text">{{ config('app.name') }}</span>
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
          @include('partials.role-menu')
        </div>
      </div>

      <div id="content" class="position-relative h-100">
        {{-- Topbar --}}
        <div class="navbar-glass navbar navbar-expand-lg px-0 px-lg-4">
          <div class="container-fluid px-lg-0">
            <div class="d-flex align-items-center gap-4">
              <div class="d-block d-lg-none">
                <a class="text-inherit" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                  <i class="ti ti-menu-2 fs-3"></i>
                </a>
              </div>
              <div class="d-none d-lg-block">
                <a class="sidebar-toggle d-flex p-3" href="javascript:void(0)">
                  <span class="collapse-mini"><i class="ti ti-arrow-bar-left text-secondary fs-5"></i></span>
                  <span class="collapse-expanded"><i class="ti ti-arrow-bar-right text-secondary fs-5"></i></span>
                </a>
              </div>
            </div>

            <ul class="list-unstyled d-flex align-items-center mb-0 gap-2">
              <li>
                <div class="dropdown">
                  <button class="btn btn-ghost btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                    <i class="ti theme-icon-active lh-1 fs-5"><i class="ti theme-icon ti-sun"></i></i>
                    <span class="visually-hidden bs-theme-text">Toggle theme</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true"><i class="ti theme-icon ti-sun"></i><span class="ms-2">Light</span></button></li>
                    <li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false"><i class="ti theme-icon ti-moon-stars"></i><span class="ms-2">Dark</span></button></li>
                    <li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false"><i class="ti theme-icon ti-circle-half-2"></i><span class="ms-2">Auto</span></button></li>
                  </ul>
                </div>
              </li>
              <li class="ms-3 dropdown">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="" class="avatar avatar-sm rounded-circle" />
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                  <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-4 py-4">
                    <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="" class="avatar avatar-md rounded-circle" />
                    <div>
                      <h4 class="mb-0 fs-5">{{ auth()->user()->name }}</h4>
                      <p class="mb-0 small text-secondary">{{ auth()->user()->email }}</p>
                      <span class="badge bg-primary text-capitalize mt-1">{{ auth()->user()->role }}</span>
                      @if (auth()->user()->is_langganan)
                        <span class="badge bg-warning text-dark">⭐ Pelanggan Langganan</span>
                        @endif
                    </div>
                  </div>
                  <div class="p-3">
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                        <i class="ti ti-logout fs-5"></i><span>Keluar</span>
                      </button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        {{-- Isi halaman --}}
        <div class="custom-container">
            @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @yield('content')
        </div>
      </div>
    </div>

    @include('partials.scripts')
    <script src="{{ asset('assets/js/vendors/sidebarnav.js') }}"></script>
  </body>
</html>
