@extends('layouts.app')

@section('content')
<div class="container my-5 text-center">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h2 class="mb-4">¡Gracias por tu compra!</h2>
  <p class="mb-4 text-muted">
    Tu pedido se ha procesado correctamente. En breve recibirás la confirmación por correo (si estás registrado).
  </p>
  <a href="{{ route('products.index') }}" class="btn btn-primary">
    Seguir comprando
  </a>
</div>
@endsection
