@extends('layouts.app')

@section('content')
<div class="container my-5">

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

  {{-- ==== GRID DE PRODUCTOS ==== --}}
  <div class="row gy-4">
    @forelse($products as $product)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100">
          <img
            src="{{ $product->image
                     ? asset('storage/'.$product->image)
                     : 'https://via.placeholder.com/300x200?text=Sin+imagen' }}"
            class="card-img-top"
            alt="{{ $product->name }}"
          >
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->name }}</h5>
            <small class="text-muted">{{ $product->category->name }}</small>
            <p class="card-text text-truncate mt-2">
              {{ Str::limit($product->description, 60) }}
            </p>
            <p class="mt-auto fw-bold">${{ number_format($product->price, 2) }}</p>
            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary mb-2">Ver detalles</a>
            <a href="#" class="btn btn-warning btn-sm">Añadir al carrito</a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <p class="text-center">No se encontraron productos.</p>
      </div>
    @endforelse
  </div>

  {{-- ==== PAGINACIÓN ==== --}}
  <div class="mt-4">
    {{ $products->links() }}
  </div>
</div>
@endsection
