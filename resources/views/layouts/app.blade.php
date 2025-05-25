<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FreshHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <header class="bg-dark text-white p-3 text-center">
        <h1>FreshHub</h1>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        &copy; {{ date('Y') }} FreshHub
    </footer>

</body>
</html>
