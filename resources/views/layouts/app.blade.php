{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FreshHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Aquí podrías enlazar tu CSS compilado -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f5f5f5;
            padding: 10px 30px;
            border-bottom: 2px solid #333;
        }

        .left-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .left-header input {
            padding: 5px 10px;
            font-size: 1rem;
        }

        .right-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .header-button:hover {
            background-color: #218838;
        }

        main {
            flex: 1;
            padding: 20px 30px;
        }

        footer {
            background-color: #f5f5f5;
            border-top: 2px solid #333;
            text-align: center;
            padding: 12px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <header>
        <div class="left-header">
            <img src="https://via.placeholder.com/50" alt="Logo" height="40">
            <span><strong>FreshHub</strong></span>
            <input type="text" placeholder="Buscar productos...">
            <a href="Blog" class="header-button">Blog</a>
            <a href="Productos" class="header-button">Productos</a>
        </div>

        <div class="right-header">
            <a href="Mi_Cuenta" class="header-button">Mi cuenta</a>
            <a href="Carrito" class="header-button">Carrito</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} FreshHub – Todos los derechos reservados
    </footer>

</body>
</html>
