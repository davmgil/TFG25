<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - FreshHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #f7f7f7;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        .hero-banner {
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://via.placeholder.com/1000x300');
            background-size: cover;
            height: 300px;
            color: black;
            font-size: 2rem;
            font-weight: bold;
        }
        .section {
            margin: 20px auto;
            padding: 20px;
            max-width: 1100px;
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 4px;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .btn {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: orange;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>FreshHub</h1>
        <input type="text" placeholder="Buscar productos..." style="padding: 8px; width: 300px;">
    </header>

    <div class="hero-banner">
        ¡Que no falte el picoteo!
    </div>

    <section class="section">
        <h2>Productos del momento</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Producto">
                <p>Producto 1</p>
                <button class="btn">Añadir al carro</button>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Producto">
                <p>Producto 2</p>
                <button class="btn">Añadir al carro</button>
            </div>
            <!-- Agrega más productos según sea necesario -->
        </div>
    </section>

    <section class="section">
        <h2>Bajadas de precio</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Oferta">
                <p>Producto en oferta</p>
                <button class="btn">Añadir al carro</button>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Oferta">
                <p>Producto en oferta</p>
                <button class="btn">Añadir al carro</button>
            </div>
        </div>
    </section>

    <footer>
        &copy; 2025 FreshHub - Todos los derechos reservados
    </footer>
</body>
</html>
