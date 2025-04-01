<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Novela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CapituloController extends Controller
{
    /**
     * Muestra un listado de capítulos de una novela.
     */
    public function index(Novela $novela)
    {
        $this->authorize('view', $novela);
        $capitulos = $novela->capitulos()->orderBy('numero_capitulo')->paginate(20);
        return view('capitulos.index', compact('novela', 'capitulos'));
    }

    /**
     * Muestra el formulario para crear un nuevo capítulo.
     */
    public function create(Novela $novela)
    {
        $this->authorize('update', $novela);
        $numero_siguiente = $novela->capitulos()->max('numero_capitulo') + 1 ?? 1;
        return view('capitulos.create', compact('novela', 'numero_siguiente'));
    }

    /**
     * Almacena un nuevo capítulo en la base de datos.
     */
    public function store(Request $request, Novela $novela)
    {
        $this->authorize('update', $novela);

        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'numero_capitulo' => 'required|integer|min:1',
            'publicado' => 'nullable|boolean',
        ]);

        $capitulo = new Capitulo([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'numero_capitulo' => $request->numero_capitulo,
            'publicado' => $request->has('publicado'),
        ]);

        $novela->capitulos()->save($capitulo);

        return redirect()->route('novelas.capitulos.show', [$novela, $capitulo])
            ->with('success', 'Capítulo creado con éxito.');
    }

    /**
     * Muestra un capítulo específico.
     */
    public function show(Novela $novela, Capitulo $capitulo)
    {
        $this->authorize('view', $novela);
        
        if ($capitulo->novela_id !== $novela->id) {
            abort(404);
        }

        // Incrementar contador de visitas
        if (!Auth::check() || Auth::id() !== $novela->user_id) {
            $capitulo->increment('visitas');
        }

        $capitulo_anterior = $novela->capitulos()
            ->where('numero_capitulo', '<', $capitulo->numero_capitulo)
            ->orderBy('numero_capitulo', 'desc')
            ->first();
            
        $capitulo_siguiente = $novela->capitulos()
            ->where('numero_capitulo', '>', $capitulo->numero_capitulo)
            ->orderBy('numero_capitulo')
            ->first();
            
        // Obtener lista de todos los capítulos para el índice
        $listaCapitulos = $novela->capitulos()->orderBy('numero_capitulo')->get();
            
        return view('capitulos.show', compact('novela', 'capitulo', 'capitulo_anterior', 'capitulo_siguiente', 'listaCapitulos'));
    }

    /**
     * Muestra el formulario para editar un capítulo.
     */
    public function edit(Novela $novela, Capitulo $capitulo)
    {
        $this->authorize('update', $novela);
        
        if ($capitulo->novela_id !== $novela->id) {
            abort(404);
        }
        
        return view('capitulos.edit', compact('novela', 'capitulo'));
    }

    /**
     * Actualiza un capítulo en la base de datos.
     */
    public function update(Request $request, Novela $novela, Capitulo $capitulo)
    {
        $this->authorize('update', $novela);
        
        if ($capitulo->novela_id !== $novela->id) {
            abort(404);
        }

        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'numero_capitulo' => 'required|integer|min:1',
            'publicado' => 'nullable|boolean',
        ]);

        $capitulo->titulo = $request->titulo;
        $capitulo->contenido = $request->contenido;
        $capitulo->numero_capitulo = $request->numero_capitulo;
        $capitulo->publicado = $request->has('publicado');
        $capitulo->save();

        return redirect()->route('novelas.capitulos.show', [$novela, $capitulo])
            ->with('success', 'Capítulo actualizado con éxito.');
    }

    /**
     * Elimina un capítulo de la base de datos.
     */
    public function destroy(Novela $novela, Capitulo $capitulo)
    {
        $this->authorize('update', $novela);
        
        if ($capitulo->novela_id !== $novela->id) {
            abort(404);
        }
        
        $capitulo->delete();

        return redirect()->route('novelas.capitulos.index', $novela)
            ->with('success', 'Capítulo eliminado con éxito.');
    }
}
