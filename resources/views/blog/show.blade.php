@extends('layouts.app')

@section('content')
<div class="container my-5">
  {{-- Mensaje flash de éxito (opcional) --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Título y fecha --}}
  <h2 class="mb-3">{{ $post->title }}</h2>
  <small class="text-muted">Publicado el {{ $post->created_at->format('d/m/Y') }}</small>

  <hr>

  {{-- Contenido con enlaces a productos --}}
  <div class="mt-4">
    {!! $content !!}
  </div>

  {{-- Botón para volver al listado --}}
  <div class="mt-5">
    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
      ← Volver a Recetas
    </a>
  </div>
</div>
@endsection
