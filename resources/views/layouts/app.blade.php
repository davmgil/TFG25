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
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      {{-- Logo y nombre (ambos apuntan a la ruta raíz "/") --}}
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="me-2">
        <span>FreshHub</span>
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

        {{-- Buscador visible en pantallas grandes --}}
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
              <a class="nav-link" href="{{ route('profile.edit') }}">Mi cuenta</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn nav-link" style="border:none; background:none; cursor:pointer;">
                  Logout
                </button>
              </form>
            </li>
          @endguest

          {{-- Carrito (visible siempre) --}}
          <li class="nav-item position-relative">
            <a class="btn btn-success ms-3 d-flex align-items-center" href="{{ route('cart.index') }}">
              <i class="bi bi-cart3 me-1"></i>
              Carrito
              @php
                // Obtener el carrito de la sesión (array de [product_id => cantidad])
                $cart = session('cart', []);
                // Sumar todas las cantidades para mostrar el total de unidades
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

  <main class="py-4">
    @yield('content')
  </main>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
