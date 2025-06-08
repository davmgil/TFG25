@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Mensajes flash --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Botón “Volver a Productos” --}}
  <div class="mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">&larr; Volver a Productos</a>
  </div>

  {{-- Detalle del producto --}}
  <div class="row gy-4">
    <div class="col-12 col-md-6">
          <img
            src="{{ $product->image
                    ? asset('storage/'.$product->image)
                    : 'https://via.placeholder.com/300x200?text=Sin+imagen' }}"
            class="card-img-top"
            alt="{{ $product->name }}"
            style="
              object-fit: cover;
              width: 300px;
              height: 300px;
              margin: 0 auto;
            "
          >
    </div>
    <div class="col-12 col-md-6 d-flex flex-column">
      <h6 class="text-muted">{{ $product->category->name }}</h6>
      <h2 class="mb-3">{{ $product->name }}</h2>
      <p>{{ $product->description }}</p>
      <p class="fw-bold fs-4 mb-4">${{ number_format($product->price,2) }}</p>

      {{-- Formulario para “Añadir al carrito” --}}
      <form method="POST" action="{{ route('cart.add', $product) }}" class="mb-4">
        @csrf
        <button type="submit" class="btn btn-warning btn-lg">
          Añadir al carrito
        </button>
      </form>

      {{-- (Opcional) Enlace a ver el carrito --}}
      <a href="{{ route('cart.index') }}" class="btn btn-success">
        <i class="bi bi-cart3 me-1"></i> Ver Carrito
      </a>
    </div>
  </div>
</div>
@endsection
