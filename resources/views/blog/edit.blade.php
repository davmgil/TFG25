@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Editar Receta</h2>

  {{-- Mostrar errores de validación --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Formulario de edición --}}
  <form action="{{ route('blog.update', $post) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Título --}}
    <div class="mb-3">
      <label for="title" class="form-label">Título</label>
      <input
        type="text"
        id="title"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $post->title) }}"
        required
      >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Contenido --}}
    <div class="mb-3">
      <label for="content" class="form-label">Contenido</label>
      <textarea
        id="content"
        name="content"
        rows="8"
        class="form-control @error('content') is-invalid @enderror"
        required
      >{{ old('content', $post->content) }}</textarea>
      @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Botones --}}
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>

  <hr class="my-4">

  {{-- Formulario para eliminar la receta --}}
  <form action="{{ route('blog.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta receta?');">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
      <i class="bi bi-trash"></i> Eliminar Receta
    </button>
  </form>
</div>
@endsection
