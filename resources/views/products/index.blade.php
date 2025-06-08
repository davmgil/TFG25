{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container my-5">

  {{-- Mensajes flash --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h1 class="text-center mb-4">¡Que no falte el picoteo!</h1>

  {{-- ==== BÚSQUEDA Y FILTROS ==== --}}
  <form method="GET" action="{{ route('products.index') }}" class="mb-4 d-flex flex-wrap gap-2">
    <input
      type="text"
      name="search"
      class="form-control"
      placeholder="Buscar productos..."
      value="{{ request('search') }}"
      style="max-width: 200px;"
    >

    <select
      name="category_id"
      class="form-select"
      style="max-width: 180px;"
    >
      <option value="">Todas las categorías</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}"
          @selected(request('category_id') == $cat->id)
        >{{ $cat->name }}</option>
      @endforeach
    </select>

    <input
      type="number"
      name="min_price"
      class="form-control"
      placeholder="Precio min"
      value="{{ request('min_price') }}"
      step="0.01"
      style="max-width: 120px;"
    >
    <input
      type="number"
      name="max_price"
      class="form-control"
      placeholder="Precio max"
      value="{{ request('max_price') }}"
      step="0.01"
      style="max-width: 120px;"
    >

    <button type="submit" class="btn btn-primary">Filtrar</button>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Limpiar</a>
  </form>
  {{-- ==== FIN BÚSQUEDA Y FILTROS ==== --}}

  {{-- ==== GRID DE PRODUCTOS ==== --}}
  <div class="row gy-4">
    @forelse($products as $product)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">

          {{-- IMAGEN --}}
          <img
            src="{{ $product->image
                    ? asset('storage/'.$product->image)
                    : 'https://via.placeholder.com/300x200?text=Sin+imagen' }}"
            class="card-img-top"
            alt="{{ $product->name }}"
            style="
              object-fit: cover;
              width: 200px;
              height: 200px;
              margin: 0 auto;
            "
          >

          <div class="card-body d-flex flex-column">
            {{-- CATEGORÍA --}}
            <h6 class="card-subtitle mb-1 text-muted">{{ $product->category->name }}</h6>
            {{-- NOMBRE --}}
            <h5 class="card-title">{{ $product->name }}</h5>
            {{-- DESCRIPCIÓN CORTA --}}
            <p class="card-text text-truncate mt-2">
              {{ \Illuminate\Support\Str::limit($product->description, 60) }}
            </p>

            {{-- PRECIO (rebajado o normal) --}}
            @if($product->sale_price)
                <p>
                    <span class="text-muted text-decoration-line-through">
                        {{ number_format($product->price, 2) }} €
                    </span>
                    <span class="text-danger fw-bold">
                        {{ number_format($product->sale_price, 2) }} €
                    </span>
                </p>
            @else
                <p>{{ number_format($product->price, 2) }} €</p>
            @endif
            <div class="mt-auto d-flex justify-content-between align-items-center">
              {{-- BOTÓN “Ver detalles” --}}
              <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                Ver detalles
              </a>

              {{-- BOTÓN “Añadir al carrito” --}}
              <form method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm">
                  Añadir
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    @empty
      <div class="col-12">
        <p class="text-center text-muted">No se encontraron productos.</p>
      </div>
    @endforelse
  </div>
  {{-- ==== FIN GRID DE PRODUCTOS ==== --}}

  {{-- ==== PAGINACIÓN ==== --}}
  <div class="mt-4 d-flex justify-content-center">
    {{ $products->appends(request()->all())->links('pagination::bootstrap-5') }}
  </div>
  {{-- ==== FIN PAGINACIÓN ==== --}}
</div>
@endsection
