<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;     // Para generar el slug automáticamente
use App\Models\Post;
use App\Models\Product;

class PostController extends Controller
{
    /**
     * Mostrar listado de entradas (blog).
     */
    public function index()
    {
        // Obtenemos todas las entradas ordenadas por fecha descendente
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog.index', compact('posts'));
    }

    /**
     * Mostrar el formulario para crear una nueva receta.
     * La ruta a este método estará protegida con middleware 'auth', 
     * de modo que si no estás logueado, serás redirigido a /login.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Almacenar la nueva receta en la base de datos.
     * También protegido con 'auth'.
     */
    public function store(Request $request)
    {
        // 1) Validar los datos recibidos
        $data = $request->validate([
            'title'   => ['required', 'string', 'max:255', 'unique:posts,title'],
            'content' => ['required', 'string'],
        ]);

        // 2) Generar un slug único a partir del título
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // 3) Crear la entrada en la base de datos
        Post::create([
            'title'   => $data['title'],
            'slug'    => $slug,
            'content' => $data['content'],
        ]);

        // 4) Redirigir al listado de blog con mensaje de éxito
        return redirect()->route('blog.index')
                         ->with('success', 'Receta creada correctamente.');
    }

    /**
     * Mostrar una entrada en detalle (por slug).
     * Laravel inyecta el modelo Post gracias a getRouteKeyName() que devuelve 'slug'.
     */
    public function show(Post $post)
    {
        // 1) Obtenemos el contenido original (texto plano)
        $content = $post->content;

        // 2) Recuperamos todos los productos para convertir nombres en enlaces
        $products = Product::all();

        // 3) Reemplazamos cada ocurrencia exacta del nombre de un producto por un <a>
        foreach ($products as $product) {
            // URL al detalle del producto
            $url = route('products.show', $product);
            // Etiqueta <a> que envolverá el nombre del producto
            $anchor = "<a href=\"{$url}\">{$product->name}</a>";

            // Patrón para coincidencias exactas, insensible a mayúsculas/minúsculas
            $pattern = '/\b' . preg_quote($product->name, '/') . '\b/i';

            // Realizamos el reemplazo en el contenido
            $content = preg_replace($pattern, $anchor, $content);
        }

        // 4) Retornamos la vista 'blog.show' pasando:
        //    - el modelo $post
        //    - la variable $content ya con los enlaces HTML
        return view('blog.show', [
            'post'    => $post,
            'content' => $content,
        ]);
    }
}
