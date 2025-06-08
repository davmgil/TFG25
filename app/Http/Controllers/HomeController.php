<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Carrusel “Más vendidos”: top 8 productos ordenados por veces vendidos
        $topProducts = Product::orderByDesc('times_sold')
                              ->take(8)
                              ->get();

        // Carrusel “Pizzas y platos preparados”
        $platos = Category::where('name', 'Pizzas y platos preparados')
                          ->with(['products' => function($q) {
                              $q->orderBy('created_at', 'desc')
                                ->take(8);
                          }])
                          ->first();

        // Carrusel “Azúcar, chocolates y caramelos”
        $chocolates = Category::where('name', 'Azúcar, chocolates y caramelos')
                              ->with(['products' => function($q) {
                                  $q->orderBy('created_at', 'desc')
                                    ->take(8);
                              }])
                              ->first();

        // Carrusel “Agua, refrescos y zumos”
        $agua = Category::where('name', 'Agua, refrescos y zumos')
                        ->with(['products' => function($q) {
                            $q->orderBy('created_at', 'desc')
                              ->take(8);
                        }])
                        ->first();

        // Retorna la vista con todas las variables necesarias
        return view('index', compact(
            'topProducts',
            'platos',
            'chocolates',
            'agua'
        ));
    }
}
