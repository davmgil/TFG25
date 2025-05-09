@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Productos</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name }}</td>
        <td>{{ number_format($product->price, 2) }} €</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $products->links() }}
</div>
@endsection
