@extends('layouts.app')

@section('content')
    <div class="section">
        <h2>Detalle de producto</h2>

        <div class="product-detail">
            <img src="{{ $product->image ?? 'https://via.placeholder.com/300' }}"
                 alt="{{ $product->name }}"
                 style="max-width:300px; display:block; margin-bottom:20px;">

            <h3>{{ $product->name }}</h3>
            <p><strong>Precio:</strong> {{ number_format($product->price, 2) }} €</p>
            <p><strong>Categoría:</strong> {{ $product->category->name ?? 'Sin categoría' }}</p>
            <p>{{ $product->description }}</p>

            <button class="btn">Añadir al carro</button>
            <a href="{{ route('products.index') }}" style="margin-left:20px;">← Volver al listado</a>
        </div>
    </div>
@endsection
