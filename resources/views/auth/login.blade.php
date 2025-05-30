@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px;">
  <h2 class="mb-4">Login</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Correo electrónico</label>
      <input type="email" name="email"
             class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email') }}" required autofocus>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Contraseña</label>
      <input type="password" name="password"
             class="form-control @error('password') is-invalid @enderror"
             required>
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" name="remember" id="remember">
      <label class="form-check-label" for="remember">Recordarme</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Acceder</button>
  </form>
</div>
@endsection
