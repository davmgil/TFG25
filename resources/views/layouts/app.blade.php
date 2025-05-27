<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>FreshHub</title>
  <!-- CDN Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('products.index') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="me-2">
        <span>FreshHub</span>
      </a>

      <form class="d-none d-lg-flex flex-grow-1 mx-3" method="GET" action="{{ route('products.index') }}">
        <input
          class="form-control"
          type="search"
          name="search"
          placeholder="Buscar productos..."
          value="{{ request('search') }}"
        >
      </form>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Productos</a></li>
        </ul>
      </div>

      <div class="d-flex">
        <a href="#" class="btn btn-outline-success me-2">Mi cuenta</a>
        <a href="#" class="btn btn-success">Carrito</a>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
