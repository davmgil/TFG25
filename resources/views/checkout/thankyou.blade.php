@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
  <h1 class="text-success mb-4">¡Gracias por tu compra!</h1>
  <p class="lead">Tu pedido ha sido procesado correctamente.</p>

  <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
    {{-- Botón: Volver al inicio --}}
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">
      Volver al inicio
    </a>

    {{-- Botón: Seguir comprando (productos) --}}
    <a href="{{ route('products.index') }}" class="btn btn-primary">
      Seguir comprando
    </a>
  </div>
</div>
@endsection
