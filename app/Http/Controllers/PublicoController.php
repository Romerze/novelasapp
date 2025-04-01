<?php

namespace App\Http\Controllers;

use App\Models\Novela;
use App\Models\Capitulo;
use App\Models\Genero;
use Illuminate\Http\Request;

class PublicoController extends Controller
{
    /**
     * Muestra la página de inicio con novelas destacadas.
     */
    public function inicio()
    {
        // Novelas destacadas (las más visitadas)
        $destacadas = Novela::where('publicada', 1)
                      ->orderBy('visitas', 'desc')
                      ->take(5)
                      ->get();
                      
        // Novelas recientes
        $recientes = Novela::where('publicada', 1)
                     ->orderBy('created_at', 'desc')
                     ->take(10)
                     ->get();
                     
        // Novelas actualizadas recientemente
        $actualizadas = Novela::where('publicada', 1)
                        ->orderBy('updated_at', 'desc')
                        ->take(10)
                        ->get();
                        
        // Géneros populares (con más novelas)
        $generos = Genero::withCount('novelas')
                   ->orderBy('novelas_count', 'desc')
                   ->take(6)
                   ->get();
                   
        return view('home', compact('destacadas', 'recientes', 'actualizadas', 'generos'));
    }
    
    /**
     * Muestra el listado de todas las novelas.
     */
    public function todasLasNovelas(Request $request)
    {
        $query = Novela::where('estado', 'publicado');
        
        // Búsqueda
        if ($request->has('buscar') && $request->buscar != '') {
            $search = $request->buscar;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }
        
        // Ordenar
        $orden = $request->orden ?? 'recientes';
        
        switch($orden) {
            case 'populares':
                $query->orderBy('visitas', 'desc');
                break;
            case 'actualizadas':
                $query->orderBy('updated_at', 'desc');
                break;
            case 'recientes':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $novelas = $query->paginate(20);
        $generos = Genero::withCount('novelas')->orderBy('novelas_count', 'desc')->get();
        
        return view('publico.novelas.index', compact('novelas', 'generos'));
    }
    
    /**
     * Muestra el detalle de una novela.
     */
    public function mostrarNovela(Novela $novela)
    {
        // Incrementar contador de visitas
        $novela->increment('visitas');
        
        // Obtener capítulos de la novela
        $capitulos = $novela->capitulos()
                     ->orderBy('numero_capitulo', 'asc')
                     ->paginate(20);
                     
        // Novelas similares (por género)
        $generoIds = $novela->generos->pluck('id')->toArray();
        
        $novelasSimilares = Novela::where('id', '!=', $novela->id)
                           ->where('estado', 'publicado')
                           ->whereHas('generos', function($query) use ($generoIds) {
                               $query->whereIn('generos.id', $generoIds);
                           })
                           ->distinct()
                           ->orderBy('visitas', 'desc')
                           ->take(5)
                           ->get();
                           
        return view('publico.novelas.show', compact('novela', 'capitulos', 'novelasSimilares'));
    }
    
    /**
     * Muestra el detalle de un capítulo.
     */
    public function mostrarCapitulo(Novela $novela, Capitulo $capitulo)
    {
        // Verificar que el capítulo pertenezca a la novela
        if ($capitulo->novela_id != $novela->id) {
            abort(404);
        }
        
        // Incrementar contador de visitas
        $capitulo->increment('visitas');
        
        // Capítulos anterior y siguiente
        $capituloAnterior = $novela->capitulos()
                            ->where('numero_capitulo', '<', $capitulo->numero_capitulo)
                            ->orderBy('numero_capitulo', 'desc')
                            ->first();
                            
        $capituloSiguiente = $novela->capitulos()
                            ->where('numero_capitulo', '>', $capitulo->numero_capitulo)
                            ->orderBy('numero_capitulo', 'asc')
                            ->first();
                            
        // Lista de todos los capítulos para navegación rápida
        $listaCapitulos = $novela->capitulos()
                          ->orderBy('numero_capitulo', 'asc')
                          ->get();
                          
        return view('publico.capitulos.show', compact(
            'novela', 
            'capitulo', 
            'capituloAnterior', 
            'capituloSiguiente', 
            'listaCapitulos'
        ));
    }
    
    /**
     * Muestra todos los géneros disponibles.
     */
    public function todosLosGeneros()
    {
        $generos = Genero::withCount('novelas')
                  ->orderBy('nombre', 'asc')
                  ->paginate(20);
                  
        return view('publico.generos.index', compact('generos'));
    }
    
    /**
     * Muestra el detalle de un género y sus novelas.
     */
    public function mostrarGenero(Request $request, Genero $genero)
    {
        $query = $genero->novelas()->where('publicada', 1);
        
        // Búsqueda dentro del género
        if ($request->has('buscar') && $request->buscar != '') {
            $search = $request->buscar;
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }
        
        $novelas = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Otros géneros para explorar
        $otrosGeneros = Genero::withCount('novelas')
                        ->orderBy('novelas_count', 'desc')
                        ->get();
                        
        return view('publico.generos.show', compact('genero', 'novelas', 'otrosGeneros'));
    }
    
    /**
     * Muestra los resultados de búsqueda.
     */
    public function buscar(Request $request)
    {
        $search = $request->q;
        
        if (empty($search)) {
            return redirect()->route('inicio');
        }
        
        $novelas = Novela::where('estado', 'publicado')
                  ->where(function($query) use ($search) {
                      $query->where('titulo', 'LIKE', "%{$search}%")
                            ->orWhere('descripcion', 'LIKE', "%{$search}%");
                  })
                  ->orderBy('visitas', 'desc')
                  ->paginate(20);
                  
        return view('buscar', compact('novelas', 'search'));
    }
}
