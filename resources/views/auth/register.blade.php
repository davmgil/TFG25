@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px;">
  <h2 class="mb-4">Registro</h2>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="name"
             class="form-control @error('name') is-invalid @enderror"
             value="{{ old('name') }}" required autofocus>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Correo electrónico</label>
      <input type="email" name="email"
             class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email') }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Contraseña</label>
      <input type="password" name="password"
             class="form-control @error('password') is-invalid @enderror"
             required>
      @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="form-label">Confirmar contraseña</label>
      <input type="password" name="password_confirmation"
             class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrarme</button>
  </form>
</div>
@endsection
