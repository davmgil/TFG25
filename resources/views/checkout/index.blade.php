@extends('layouts.app')

@section('content')
<div class="container my-5">

  <h2 class="mb-4">Confirmar tu pedido</h2>

  {{-- Mensajes flash de error --}}
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if(count($productsInCart) > 0)
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th scope="col">Producto</th>
          <th scope="col" style="width: 120px;">Cantidad</th>
          <th scope="col" style="width: 120px;">Precio Uni.</th>
          <th scope="col" style="width: 120px;">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($productsInCart as $item)
          <tr>
            <td class="d-flex align-items-center">
              <img
                src="{{ $item['product']->image
                         ? asset('storage/'.$item['product']->image)
                         : 'https://via.placeholder.com/80x60?text=Sin+imagen' }}"
                alt="{{ $item['product']->name }}"
                style="width: 80px; height: 60px; object-fit: cover;"
                class="me-3 rounded"
              >
              <span>{{ $item['product']->name }}</span>
            </td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($item['product']->price, 2) }}</td>
            <td>${{ number_format($item['subtotal'], 2) }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-end fw-bold">Total a Pagar:</td>
          <td class="fw-bold">${{ number_format($total, 2) }}</td>
        </tr>
      </tfoot>
    </table>

    {{-- Formulario para confirmar compra --}}
    <form method="POST" action="{{ route('checkout.store') }}">
      @csrf
      <button type="submit" class="btn btn-primary btn-lg">
        Confirmar Pedido
      </button>
      <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary ms-2">
        ← Volver al Carrito
      </a>
    </form>
  @else
    <p class="text-center fs-5 text-muted">Tu carrito está vacío.</p>
    <div class="text-center mt-4">
      <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Ver Productos</a>
    </div>
  @endif

</div>
@endsection
