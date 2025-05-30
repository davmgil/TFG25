@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px;">
  <h2 class="mb-4">Mi cuenta</h2>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="name"
             class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name', $user->name) }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Correo electrónico</label>
      <input type="email" name="email"
             class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email', $user->email) }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
  </form>
</div>
@endsection
