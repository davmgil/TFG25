@extends('layouts.app')

@section('content')
<div class="container my-5">
  {{-- Mensaje flash de éxito --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Título, autor y fecha --}}
  <h2 class="mb-3">{{ $post->title }}</h2>
  <small class="text-muted">
    {{-- Comprobamos si existe el autor; si no, "Desconocido" --}}
    Por {{ optional($post->user)->name ?? 'Desconocido' }}
    el {{ $post->created_at->format('d/m/Y') }}
  </small>

  <hr>

  {{-- Contenido con enlaces a productos --}}
  <div class="mt-4">
    {!! $content !!}
  </div>

  {{-- Botones de acción --}}
  <div class="mt-5 d-flex gap-2">
    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
      ← Volver a Recetas
    </a>

    @auth
      @if(Auth::id() === $post->user_id)
        <a href="{{ route('blog.edit', $post) }}" class="btn btn-outline-primary">
          Editar Receta
        </a>
      @endif
    @endauth
  </div>
</div>
@endsection
