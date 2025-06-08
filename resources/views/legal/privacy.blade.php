@extends('layouts.app')

@section('title', 'Política de Privacidad')

@section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Política de Privacidad</h1>
    <p>
      En FreshHub protegemos tus datos personales conforme al RGPD. Aquí explicamos qué datos
      recopilamos, con qué finalidad y cómo ejercer tus derechos.
    </p>

    <h2 class="text-xl font-semibold mt-6">1. Responsable del tratamiento</h2>
    <p>
      FreshHub S.L., CIF B12345678, C/ Claridad, 28000 Madrid, es responsable del tratamiento de
      tus datos.
    </p>

    <h2 class="text-xl font-semibold mt-6">2. Datos que recopilamos</h2>
    <ul class="list-disc ml-6">
      <li>Nombre, apellidos y datos de contacto.</li>
      <li>Dirección de envío y facturación.</li>
      <li>Historial de pedidos.</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6">3. Derechos ARCO y RGPD</h2>
    <p>
      Tienes derecho a acceder, rectificar, suprimir y limitar el uso de tus datos. Para ello,
      contáctanos en privacidad@freshhub.com.
    </p>
  </div>
@endsection
