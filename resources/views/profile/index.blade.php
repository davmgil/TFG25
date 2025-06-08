@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h2 class="mb-4">Mi Cuenta</h2>

  {{-- Mensajes éxito o error --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  {{-- Secciones --}}
  <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">
        Pedidos
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">
        Datos Personales
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses" type="button" role="tab">
        Direcciones
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab">
        Métodos de Pago
      </button>
    </li>
  </ul>

  <div class="tab-content" id="profileTabsContent">

    {{-- Sección Pedidos --}}
    <div class="tab-pane fade show active" id="orders" role="tabpanel">
      @if($orders->isEmpty())
        <p class="text-muted">Aún no has realizado ningún pedido.</p>
      @else
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pedido #</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalles</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                  <td>${{ number_format($order->total, 2) }}</td>
                  <td>
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#orderItems{{ $order->id }}">
                      Ver items
                    </button>
                  </td>
                </tr>
                <tr class="collapse" id="orderItems{{ $order->id }}">
                  <td colspan="4">
                    <ul class="list-group">
                      @foreach($order->orderItems as $item)
                        <li class="list-group-item">
                          {{ $item->product->name }} — Cantidad: {{ $item->quantity }} — Precio: ${{ number_format($item->price, 2) }}
                        </li>
                      @endforeach
                    </ul>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{-- Paginación pedidos --}}
          <div class="mt-3">
            {{ $orders->links('pagination::bootstrap-5') }}
          </div>
        </div>
      @endif
    </div>

      {{-- Datos personales --}}
    <div class="tab-pane fade" id="personal" role="tabpanel">
      <div class="row">
        <div class="col-md-6">
          {{-- Formulario para actualizar Nombre y Correo --}}
          <h5>Editar Nombre y Correo</h5>
          <form action="{{ route('profile.updateProfile') }}" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
              >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
              >
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </form>
        </div>
      </div>
    </div>


      {{-- Direcciones --}}
    <div class="tab-pane fade" id="addresses" role="tabpanel">
      <h5 class="mb-3">Tus Direcciones</h5>

      {{-- Lista actual de direcciones --}}
      @if($addresses->isEmpty())
        <p class="text-muted">No tienes direcciones guardadas.</p>
      @else
        <div class="table-responsive mb-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Etiqueta</th>
                <th>Calle</th>
                <th>Ciudad</th>
                <th>Provincia</th>
                <th>Código Postal</th>
                <th>País</th>
                <th>Predeterminada</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($addresses as $address)
                <tr>
                  <td>{{ $address->label ?? '–' }}</td>
                  <td>{{ $address->street }}</td>
                  <td>{{ $address->city }}</td>
                  <td>{{ $address->state ?? '–' }}</td>
                  <td>{{ $address->zip_code ?? '–' }}</td>
                  <td>{{ $address->country }}</td>
                  <td>
                    @if($address->is_default)
                      <span class="badge bg-success">Sí</span>
                    @else
                      <span class="badge bg-secondary">No</span>
                    @endif
                  </td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalEditAddress{{ $address->id }}">
                      Editar
                    </button>
                    <form action="{{ route('profile.addresses.destroy', $address) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta dirección?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>

                {{-- Modal para editar esta dirección --}}
                <div class="modal fade" id="modalEditAddress{{ $address->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('profile.addresses.update', $address) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title">Editar Dirección</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="label{{ $address->id }}" class="form-label">Etiqueta</label>
                            <input type="text" id="label{{ $address->id }}" name="label"
                                   class="form-control"
                                   value="{{ old('label', $address->label) }}">
                          </div>
                          <div class="mb-3">
                            <label for="street{{ $address->id }}" class="form-label">Calle</label>
                            <input type="text" id="street{{ $address->id }}" name="street"
                                   class="form-control"
                                   value="{{ old('street', $address->street) }}" required>
                          </div>
                          <div class="mb-3">
                            <label for="city{{ $address->id }}" class="form-label">Ciudad</label>
                            <input type="text" id="city{{ $address->id }}" name="city"
                                   class="form-control"
                                   value="{{ old('city', $address->city) }}" required>
                          </div>
                          <div class="mb-3">
                            <label for="state{{ $address->id }}" class="form-label">Provincia</label>
                            <input type="text" id="state{{ $address->id }}" name="state"
                                   class="form-control"
                                   value="{{ old('state', $address->state) }}">
                          </div>
                          <div class="mb-3">
                            <label for="zip_code{{ $address->id }}" class="form-label">Código Postal</label>
                            <input type="text" id="zip_code{{ $address->id }}" name="zip_code"
                                   class="form-control"
                                   value="{{ old('zip_code', $address->zip_code) }}">
                          </div>
                          <div class="mb-3">
                            <label for="country{{ $address->id }}" class="form-label">País</label>
                            <input type="text" id="country{{ $address->id }}" name="country"
                                   class="form-control"
                                   value="{{ old('country', $address->country) }}" required>
                          </div>

                          {{-- Checkbox para “Marcar como principal” --}}
                          <div class="mb-3 form-check">
                            <input type="hidden" name="is_default" value="0">
                            <input
                              type="checkbox"
                              class="form-check-input"
                              id="is_default{{ $address->id }}"
                              name="is_default"
                              value="1"
                              @checked(old('is_default', $address->is_default))
                            >
                            <label class="form-check-label" for="is_default{{ $address->id }}">
                              Marcar como principal
                            </label>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      {{-- Formulario para añadir nueva dirección --}}
      <h5 class="mt-4">Añadir Nueva Dirección</h5>
      <form action="{{ route('profile.addresses.store') }}" method="POST" class="mb-5">
        @csrf

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="label_new" class="form-label">Etiqueta</label>
            <input type="text" id="label_new" name="label"
                   class="form-control @error('label') is-invalid @enderror"
                   value="{{ old('label') }}">
            @error('label')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-8 mb-3">
            <label for="street_new" class="form-label">Calle</label>
            <input type="text" id="street_new" name="street"
                   class="form-control @error('street') is-invalid @enderror"
                   value="{{ old('street') }}" required>
            @error('street')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="city_new" class="form-label">Ciudad</label>
            <input type="text" id="city_new" name="city"
                   class="form-control @error('city') is-invalid @enderror"
                   value="{{ old('city') }}" required>
            @error('city')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="state_new" class="form-label">Provincia</label>
            <input type="text" id="state_new" name="state"
                   class="form-control @error('state') is-invalid @enderror"
                   value="{{ old('state') }}">
            @error('state')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="zip_code_new" class="form-label">Código Postal</label>
            <input type="text" id="zip_code_new" name="zip_code"
                   class="form-control @error('zip_code') is-invalid @enderror"
                   value="{{ old('zip_code') }}">
            @error('zip_code')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="country_new" class="form-label">País</label>
            <input type="text" id="country_new" name="country"
                   class="form-control @error('country') is-invalid @enderror"
                   value="{{ old('country') }}" required>
            @error('country')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Checkbox para nueva dirección --}}
          <div class="col-md-4 align-self-end mb-3 form-check">
            <input type="hidden" name="is_default" value="0">
            <input type="checkbox" class="form-check-input" id="is_default_new" name="is_default" value="1"
                   @checked(old('is_default'))>
            <label class="form-check-label" for="is_default_new">Marcar como principal</label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Dirección</button>
      </form>
    </div>


    {{-- Métodos de pago --}}
    <div class="tab-pane fade" id="payments" role="tabpanel">
      <h5 class="mb-3">Tus Métodos de Pago</h5>

      {{-- Lista actual de métodos --}}
      @if($payments->isEmpty())
        <p class="text-muted">No tienes métodos de pago guardados.</p>
      @else
        <div class="table-responsive mb-4">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Titular</th>
                <th>Últimos 4 dígitos</th>
                <th>Vence</th>
                <th>Predeterminado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($payments as $pm)
                <tr>
                  <td>{{ $pm->cardholder_name }}</td>
                  <td>**** **** **** {{ $pm->card_number_last4 }}</td>
                  <td>{{ str_pad($pm->expiry_month,2,'0',STR_PAD_LEFT) }}/{{ $pm->expiry_year }}</td>
                  <td>
                    @if($pm->is_default)
                      <span class="badge bg-success">Sí</span>
                    @else
                      <span class="badge bg-secondary">No</span>
                    @endif
                  </td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalEditPayment{{ $pm->id }}">
                      Editar
                    </button>
                    <form action="{{ route('profile.payments.destroy', $pm) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este método de pago?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>

                {{-- Modal para editar este método --}}
                <div class="modal fade" id="modalEditPayment{{ $pm->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('profile.payments.update', $pm) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title">Editar Método de Pago</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="cardholder_name{{ $pm->id }}" class="form-label">Titular</label>
                            <input type="text" id="cardholder_name{{ $pm->id }}" name="cardholder_name"
                                   class="form-control @error('cardholder_name') is-invalid @enderror"
                                   value="{{ old('cardholder_name', $pm->cardholder_name) }}" required>
                            @error('cardholder_name')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="expiry_month{{ $pm->id }}" class="form-label">Mes Vence (1-12)</label>
                              <input type="number" id="expiry_month{{ $pm->id }}" name="expiry_month"
                                     class="form-control @error('expiry_month') is-invalid @enderror"
                                     value="{{ old('expiry_month', $pm->expiry_month) }}" required min="1" max="12">
                              @error('expiry_month')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="expiry_year{{ $pm->id }}" class="form-label">Año Vence</label>
                              <input type="number" id="expiry_year{{ $pm->id }}" name="expiry_year"
                                     class="form-control @error('expiry_year') is-invalid @enderror"
                                     value="{{ old('expiry_year', $pm->expiry_year) }}" required min="{{ date('Y') }}">
                              @error('expiry_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          {{-- Checkbox para “Marcar como principal” --}}
                          <div class="mb-3 form-check">
                            <input type="hidden" name="is_default" value="0">
                            <input
                              type="checkbox"
                              class="form-check-input"
                              id="is_default{{ $pm->id }}"
                              name="is_default"
                              value="1"
                              @checked(old('is_default', $pm->is_default))
                            >
                            <label class="form-check-label" for="is_default{{ $pm->id }}">
                              Marcar como principal
                            </label>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif

      {{-- Formulario para añadir nuevo método de pago --}}
      <h5 class="mt-4">Añadir Nuevo Método de Pago</h5>
      <form action="{{ route('profile.payments.store') }}" method="POST" class="mb-5">
        @csrf

        <div class="mb-3">
          <label for="cardholder_name_new" class="form-label">Titular</label>
          <input type="text" id="cardholder_name_new" name="cardholder_name"
                 class="form-control @error('cardholder_name') is-invalid @enderror"
                 value="{{ old('cardholder_name') }}" required>
          @error('cardholder_name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="card_number_new" class="form-label">Número de Tarjeta (16 dígitos)</label>
            <input type="text" id="card_number_new" name="card_number"
                   class="form-control @error('card_number') is-invalid @enderror"
                   value="{{ old('card_number') }}" required maxlength="16">
            @error('card_number')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="expiry_month_new" class="form-label">Mes Vence (1-12)</label>
            <input type="number" id="expiry_month_new" name="expiry_month"
                   class="form-control @error('expiry_month') is-invalid @enderror"
                   value="{{ old('expiry_month') }}" required min="1" max="12">
            @error('expiry_month')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-4 mb-3">
            <label for="expiry_year_new" class="form-label">Año Vence</label>
            <input type="number" id="expiry_year_new" name="expiry_year"
                   class="form-control @error('expiry_year') is-invalid @enderror"
                   value="{{ old('expiry_year') }}" required min="{{ date('Y') }}">
            @error('expiry_year')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- Checkbox corregido para nuevo método de pago --}}
        <div class="form-check mb-3">
          <input type="hidden" name="is_default" value="0">
          <input type="checkbox" class="form-check-input" id="is_default_new_pm" name="is_default" value="1"
                 @checked(old('is_default'))>
          <label class="form-check-label" for="is_default_new_pm">Marcar como principal</label>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Método de Pago</button>
      </form>
    </div>
  </div>
</div>
@endsection
