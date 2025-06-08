<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>FreshHub</title>
  <!-- CDN Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons (para el icono del carrito) -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<style>
  @media (max-width: 575.98px) {
    .carousel-item .row > [class*="col-"] {
      flex: 0 0 100% !important;
      max-width: 100% !important;
    }
  }
</style>

<body class="d-flex flex-column min-vh-100">

  {{-- Navbar sticky al hacer scroll --}}
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      {{-- Logo y nombre --}}
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        {{-- Usamos la función Storage::url() para acceder a archivos en storage --}}
        <img src="{{ Storage::url('logo/logo.png') }}" 
            alt="Logo de FreshHub" 
            style="height: 40px; width: auto;"
            class="me-2">
      </a>
      {{-- Botón hamburguesa para pantallas pequeñas --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      {{-- Menú principal --}}
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
          </li>
        </ul>

        {{-- Buscador: se oculta en < lg --}}
        <form class="d-none d-lg-flex mx-3 flex-grow-1" method="GET" action="{{ route('products.index') }}">
          <input
            class="form-control"
            type="search"
            name="search"
            placeholder="Buscar productos..."
            value="{{ request('search') }}"
          >
        </form>

        {{-- Enlaces de autenticación y carrito --}}
        <ul class="navbar-nav mb-2 mb-lg-0">
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile.index') }}">Mi cuenta</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn nav-link p-0" style="border:none; background:none; cursor:pointer;">
                  Logout
                </button>
              </form>
            </li>
          @endguest

          {{-- Carrito (siempre visible) --}}
          <li class="nav-item position-relative ms-3">
            <a class="btn btn-success d-flex align-items-center" href="{{ route('cart.index') }}">
              <i class="bi bi-cart3 me-1"></i>
              Carrito
              @php
                $cart = session('cart', []);
                $totalQuantity = array_sum($cart);
              @endphp
              @if($totalQuantity > 0)
                <span
                  class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                  style="font-size: 0.65rem;"
                >
                  {{ $totalQuantity }}
                </span>
              @endif
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="flex-grow-1 py-4">
    @yield('content')
  </main>

  <footer class="bg-light text-center text-muted py-4 border-top mt-auto">
    <div class="container">
      <div class="mb-3 d-flex justify-content-center flex-wrap gap-3">
        <a href="{{ route('cookies.policy') }}" class="btn btn-link btn-sm text-muted">Política de cookies</a>
        <a href="{{ route('terms.conditions') }}" class="btn btn-link btn-sm text-muted">Términos y condiciones</a>
        <a href="{{ route('privacy.policy') }}" class="btn btn-link btn-sm text-muted">Política de privacidad</a>
      </div>
      <small>&copy; {{ date('Y') }} FreshHub. Todos los derechos reservados.</small>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
