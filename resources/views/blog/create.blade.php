@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Añadir Nueva Receta</h2>

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

  {{-- Formulario --}}
  <form action="{{ route('blog.store') }}" method="POST">
    @csrf

    {{-- Título --}}
    <div class="mb-3">
      <label for="title" class="form-label">Título de la Receta</label>
      <input
        type="text"
        id="title"
        name="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title') }}"
        required
      >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Contenido --}}
    <div class="mb-3">
      <label for="content" class="form-label">Contenido (menciona productos aquí)</label>
      <textarea
        id="content"
        name="content"
        rows="8"
        class="form-control @error('content') is-invalid @enderror"
        required
      >{{ old('content') }}</textarea>
      @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      <div class="form-text">
        Dentro del texto, cada vez que escribas el nombre exacto de un producto (por ejemplo “Manzana”), se convertirá automáticamente en un enlace a su detalle.
      </div>
    </div>

    {{-- Botones --}}
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Guardar Receta</button>
      <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</div>
@endsection
