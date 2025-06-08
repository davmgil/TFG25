@extends('layouts.app')

@section('content')
  <div class="text-center py-8">
    <h1 class="text-4xl font-bold text-gray-800">Bienvenidos a FreshHub</h1>
  </div>

  <div class="container my-5">

{{-- Carrusel de productos más vendidos --}}
@if($topProducts->isNotEmpty())
  <div class="mb-5">
    <h3 class="mb-3">Más vendidos</h3>

    {{-- Carrusel (ordenador) productos más vendidos --}}
    <div id="carouselTopDesktop"
         class="carousel slide d-none d-sm-block"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($topProducts->chunk(4) as $idx => $chunk)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="row gx-3">
              @foreach($chunk as $product)
                <div class="col-6 col-md-3">
                  <div class="card h-100 shadow-sm text-center">
                    <img
                      src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/120?text=Sin+imagen' }}"
                      class="mx-auto mt-3"
                      style="width:80px; height:80px; object-fit:cover;"
                      alt="{{ $product->name }}"
                    >
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,20) }}</h6>
                      <p class="mb-1"><small>Vendidos: {{ $product->times_sold }}</small></p>
                      <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">
                        Ver detalles
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTopDesktop" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselTopDesktop" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    {{-- Carrusel (móvil) productos más vendidos  --}}
    <div id="carouselTopMobile"
         class="carousel slide d-block d-sm-none"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($topProducts as $idx => $product)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="d-flex align-items-start px-3" style="overflow:hidden;">
              <div class="card h-100 shadow-sm me-2 flex-shrink-0" style="width:75%;">
                <img
                  src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=Sin+imagen' }}"
                  class="card-img-top"
                  style="object-fit:cover;"
                  alt="{{ $product->name }}"
                >
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,25) }}</h6>
                  <p class="mb-1"><small>Vendidos: {{ $product->times_sold }}</small></p>
                  <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">
                    Ver detalles
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselTopMobile" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselTopMobile" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
@endif


{{-- Carrusel de la categoría "Pizzas y platos preparados" --}}
@if($platos && $platos->products->isNotEmpty())
  <div class="mb-5">
    <h3 class="mb-3">Pizzas y platos preparados</h3>

    {{-- Carrusel (ordenador) de la categoría "Pizzas y platos preparados"  --}}
    <div id="carouselPlatosDesktop"
         class="carousel slide d-none d-sm-block"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($platos->products->chunk(4) as $idx => $chunk)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="row gx-3">
              @foreach($chunk as $product)
                <div class="col-6 col-md-3">
                  <div class="card h-100 shadow-sm text-center">
                    <img
                      src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/120?text=No+imagen' }}"
                      class="mx-auto mt-3"
                      style="width:120px; height:120px; object-fit:cover;"
                      alt="{{ $product->name }}"
                    >
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,20) }}</h6>
                      <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlatosDesktop" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselPlatosDesktop" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    {{-- Carrusel (móvil) de la categoría "Pizzas y platos preparados" --}}
    <div id="carouselPlatosMobile"
         class="carousel slide d-block d-sm-none"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($platos->products as $idx => $product)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="d-flex align-items-start px-3" style="overflow:hidden;">
              <div class="card h-100 shadow-sm me-2 flex-shrink-0" style="width:75%;">
                <img
                  src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+imagen' }}"
                  class="card-img-top"
                  style="object-fit:cover;"
                  alt="{{ $product->name }}"
                >
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,25) }}</h6>
                  <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlatosMobile" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselPlatosMobile" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
@endif

{{-- Carrusel de la categoría "Agua, refrescos y zumos" --}}
@if($agua && $agua->products->isNotEmpty())
  <div class="mb-5">
    <h3 class="mb-3">Agua, refrescos y zumos</h3>

    {{-- Carrusel (ordenador) de la categoría "Agua, refrescos y zumos" --}}
    <div id="carouselAguaDesktop"
         class="carousel slide d-none d-sm-block"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($agua->products->chunk(4) as $idx => $chunk)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="row gx-3">
              @foreach($chunk as $product)
                <div class="col-6 col-md-3">
                  <div class="card h-100 shadow-sm text-center">
                    <img
                      src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/120?text=No+imagen' }}"
                      class="mx-auto mt-3"
                      style="width:80px; height:80px; object-fit:cover;"
                      alt="{{ $product->name }}"
                    >
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,20) }}</h6>
                      <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselAguaDesktop" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselAguaDesktop" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    {{-- Carrusel (móvil) de la categoría "Agua, refrescos y zumos" --}}
    <div id="carouselAguaMobile"
         class="carousel slide d-block d-sm-none"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($agua->products as $idx => $product)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="d-flex align-items-start px-3" style="overflow:hidden;">
              <div class="card h-100 shadow-sm me-2 flex-shrink-0" style="width:75%;">
                <img
                  src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+imagen' }}"
                  class="card-img-top"
                  style="object-fit:cover;"
                  alt="{{ $product->name }}"
                >
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,25) }}</h6>
                  <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselAguaMobile" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselAguaMobile" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
@endif

{{-- Carrusel de la categoría "Azúcar, chocolates y caramelos" --}}
@if($chocolates && $chocolates->products->isNotEmpty())
  <div class="mb-5">
    <h3 class="mb-3">Azúcar, chocolates y caramelos</h3>

    {{-- Carrusel (ordenador) de la categoría "Azúcar, chocolates y caramelos" --}}
    <div id="carouselChocolatesDesktop"
         class="carousel slide d-none d-sm-block"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($chocolates->products->chunk(4) as $idx => $chunk)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="row gx-3">
              @foreach($chunk as $product)
                <div class="col-6 col-md-3">
                  <div class="card h-100 shadow-sm text-center">
                    <img
                      src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/120?text=No+imagen' }}"
                      class="mx-auto mt-3"
                      style="width:120px; height:120px; object-fit:cover;"
                      alt="{{ $product->name }}"
                    >
                    <div class="card-body d-flex flex-column">
                      <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,20) }}</h6>
                      <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselChocolatesDesktop" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselChocolatesDesktop" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    {{-- Carrusel (móvil) de la categoría "Azúcar, chocolates y caramelos" --}}
    <div id="carouselChocolatesMobile"
         class="carousel slide d-block d-sm-none"
         data-bs-ride="carousel"
         data-bs-interval="4000">
      <div class="carousel-inner">
        @foreach($chocolates->products as $idx => $product)
          <div class="carousel-item @if($idx===0) active @endif">
            <div class="d-flex align-items-start px-3" style="overflow:hidden;">
              <div class="card h-100 shadow-sm me-2 flex-shrink-0" style="width:75%;">
                <img
                  src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200?text=No+imagen' }}"
                  class="card-img-top"
                  style="object-fit:cover;"
                  alt="{{ $product->name }}"
                >
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title">{{ \Illuminate\Support\Str::limit($product->name,25) }}</h6>
                  <a href="{{ route('products.show',$product) }}" class="btn btn-sm btn-primary mt-auto">Ver detalles</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselChocolatesMobile" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselChocolatesMobile" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
@endif
  </div>
@endsection