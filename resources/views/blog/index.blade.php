@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Recetas en el Blog</h2>

    {{-- Botón “Añadir Receta” siempre visible; middleware('auth') redirige a /login si no estás logueado --}}
    <a href="{{ route('blog.create') }}" class="btn btn-success">
      <i class="bi bi-plus-lg me-1"></i> Añadir Receta
    </a>
  </div>

  {{-- Mensaje flash de éxito --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($posts->isEmpty())
    <p class="text-center text-muted">No hay entradas de blog por el momento.</p>
  @else
    <div class="list-group">
      @foreach($posts as $post)
        <a href="{{ route('blog.show', $post) }}" class="list-group-item list-group-item-action mb-2">
          <h5 class="mb-1">{{ $post->title }}</h5>
          <small class="text-muted">
            {{-- Si no hay usuario, mostramos "Desconocido" --}}
            Por {{ optional($post->user)->name ?? 'Desconocido' }}
            el {{ $post->created_at->format('d/m/Y') }}
          </small>
          <p class="mb-1 text-truncate">{!! \Illuminate\Support\Str::limit($post->content, 100) !!}</p>
        </a>
      @endforeach
    </div>
  @endif
</div>
@endsection
