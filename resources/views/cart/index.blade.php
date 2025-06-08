@extends('layouts.app')

@section('content')
<div class="container my-5">

  <h2 class="mb-4">Tu Carrito de Compras</h2>

  {{-- Mensajes flash --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(count($productsInCart) > 0)
    <table class="table table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th scope="col">Producto</th>
          <th scope="col" style="width: 120px;">Cantidad</th>
          <th scope="col" style="width: 120px;">Precio Uni.</th>
          <th scope="col" style="width: 120px;">Subtotal</th>
          <th scope="col" style="width: 100px;">Acción</th>
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
                style="width: 60px; height: 60px; object-fit: cover;"
                class="me-3 rounded"
              >
              <span>{{ $item['product']->name }}</span>
            </td>
            <td>{{ $item['quantity'] }}</td>

            {{-- Cambiado: usamos unit_price calculado desde el controlador --}}
            <td>{{ number_format($item['unit_price'], 2) }}€</td>
            
            <td>{{ number_format($item['subtotal'], 2) }}€</td>
            <td>
              <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">
                  Quitar
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-end fw-bold">Total a Pagar:</td>
          <td colspan="2" class="fw-bold">{{ number_format($total,2) }}€</td>
        </tr>
      </tfoot>
    </table>

    {{-- Botón para “Proceder al Checkout” (si ya implementaste esa ruta) --}}
    <div class="text-end">
      <a href="{{ route('checkout.index') ?? '#' }}" class="btn btn-primary">
        Proceder al Checkout
      </a>
    </div>
  @else
    <p class="text-center fs-5 text-muted">Tu carrito está vacío.</p>
    <div class="text-center mt-4">
      <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
        Ver Productos
      </a>
    </div>
  @endif

</div>
@endsection
