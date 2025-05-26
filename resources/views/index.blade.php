{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Banner principal --}}
    <div class="hero-banner mb-5" style="
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('https://via.placeholder.com/1000x300');
        background-size: cover;
        height: 300px;
        color: black;
        font-size: 2rem;
        font-weight: bold;
    ">
        ¡Que no falte el picoteo!
    </div>

    {{-- Sección: Productos del momento --}}
    <section class="section mb-5">
        <h2>Productos del momento</h2>
        <div class="products-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        ">
            @for($i = 1; $i <= 4; $i++)
                <div class="product-card" style="
                    border: 1px solid #ddd;
                    padding: 10px;
                    text-align: center;
                    border-radius: 4px;
                ">
                    <img src="https://via.placeholder.com/150" alt="Producto {{ $i }}" style="width:100%;height:auto">
                    <p>Producto {{ $i }}</p>
                    <button class="btn" style="
                        margin-top: 10px;
                        padding: 8px 16px;
                        background-color: orange;
                        border: none;
                        color: white;
                        cursor: pointer;
                    ">Añadir al carro</button>
                </div>
            @endfor
        </div>
    </section>

    {{-- Sección: Bajadas de precio --}}
    <section class="section mb-5">
        <h2>Bajadas de precio</h2>
        <div class="products-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        ">
            @for($i = 1; $i <= 6; $i++)
                <div class="product-card" style="
                    border: 1px solid #ddd;
                    padding: 10px;
                    text-align: center;
                    border-radius: 4px;
                ">
                    <img src="https://via.placeholder.com/150" alt="Oferta {{ $i }}" style="width:100%;height:auto">
                    <p>Oferta {{ $i }}</p>
                    <button class="btn" style="
                        margin-top: 10px;
                        padding: 8px 16px;
                        background-color: orange;
                        border: none;
                        color: white;
                        cursor: pointer;
                    ">Añadir al carro</button>
                </div>
            @endfor
        </div>
    </section>
@endsection
