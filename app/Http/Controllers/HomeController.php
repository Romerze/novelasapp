<?php

namespace App\Http\Controllers;

use App\Models\Novela;
use App\Models\Genero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la página principal con novelas destacadas y populares.
     */
    public function index()
    {
        // Obtener novelas destacadas (por ahora, las más recientes que estén publicadas)
        $novelasDestacadas = Novela::where('publicada', true)
            ->latest()
            ->take(6)
            ->get();
            
        // Obtener novelas populares (las más visitadas)
        $novelasPopulares = Novela::where('publicada', true)
            ->orderBy('visitas', 'desc')
            ->take(8)
            ->get();
            
        // Obtener novelas recién actualizadas (basado en la última actualización de capítulos)
        $novelasActualizadas = Novela::where('publicada', true)
            ->whereHas('capitulos', function($query) {
                $query->where('publicado', true)
                    ->orderBy('created_at', 'desc');
            })
            ->distinct()
            ->take(6)
            ->get();
            
        // Obtener los géneros con novelas publicadas
        $generos = Genero::whereHas('novelas', function($query) {
            $query->where('publicada', true);
        })->take(10)->get();
        
        return view('home', compact(
            'novelasDestacadas',
            'novelasPopulares',
            'novelasActualizadas',
            'generos'
        ));
    }
    
    /**
     * Muestra los resultados de búsqueda de novelas.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $novelas = Novela::where('publicada', true)
            ->where(function($q) use ($query) {
                $q->where('titulo', 'like', "%{$query}%")
                  ->orWhere('sinopsis', 'like', "%{$query}%");
            })
            ->paginate(12);
            
        return view('search', compact('novelas', 'query'));
    }
}
