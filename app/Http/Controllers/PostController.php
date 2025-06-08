<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // para obtener al usuario logueado
use App\Models\Post;
use App\Models\Product;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => ['required', 'string', 'max:255', 'unique:posts,title'],
            'content' => ['required', 'string'],
        ]);

        // Generar slug único
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Crear el post con user_id del autor actual
        Post::create([
            'title'   => $data['title'],
            'slug'    => $slug,
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Receta creada correctamente.');
    }

    public function edit(Post $post)
    {
        // Verificar que el usuario actual sea el autor
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Solo el autor puede actualizar
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $data = $request->validate([
            // Si cambia el título, validar unicidad ignorando este mismo id
            'title'   => ['required', 'string', 'max:255', 'unique:posts,title,' . $post->id],
            'content' => ['required', 'string'],
        ]);

        // Si el título cambió, regeneramos slug
        if ($data['title'] !== $post->title) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '<>', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $post->slug = $slug;
        }

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->save();

        return redirect()->route('blog.show', $post)
                         ->with('success', 'Receta actualizada correctamente.');
    }

    public function show(Post $post)
    {
        // Enlaza automáticamente nombres de productos en con su páagina de detalles
        $content = $post->content;
        $products = Product::all();

        foreach ($products as $product) {
            $url = route('products.show', $product);
            $anchor = "<a href=\"{$url}\">{$product->name}</a>";
            $pattern = '/\b' . preg_quote($product->name, '/') . '\b/i';
            $content = preg_replace($pattern, $anchor, $content);
        }

        return view('blog.show', [
            'post'    => $post,
            'content' => $content,
        ]);
    }

    public function destroy(Post $post)
{
    // Solo el autor puede eliminar
    if (Auth::id() !== $post->user_id) {
        abort(403);
    }

    $post->delete();

    return redirect()->route('blog.index')->with('success', 'Receta eliminada correctamente.');
}

}
