<?php

namespace App\Http\Controllers;

use App\Models\Novela;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NovelaController extends Controller
{
    /**
     * Muestra un listado de novelas.
     */
    public function index()
    {
        $novelas = Novela::with('generos')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('novelas.index', compact('novelas'));
    }

    /**
     * Muestra el formulario para crear una nueva novela.
     */
    public function create()
    {
        $generos = Genero::all();
        return view('novelas.create', compact('generos'));
    }

    /**
     * Almacena una nueva novela en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'sinopsis' => 'required',
            'imagen_portada' => 'nullable|image|max:2048',
            'generos' => 'nullable|array',
        ]);

        $novela = new Novela([
            'titulo' => $request->titulo,
            'sinopsis' => $request->sinopsis,
            'publicada' => $request->has('publicada'),
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('imagen_portada')) {
            $path = $request->file('imagen_portada')->store('portadas', 'public');
            $novela->imagen_portada = $path;
        }

        $novela->save();

        if ($request->has('generos')) {
            $novela->generos()->attach($request->generos);
        }

        return redirect()->route('novelas.index')
            ->with('success', 'Novela creada con éxito.');
    }

    /**
     * Muestra una novela específica.
     */
    public function show(Novela $novela)
    {
        $this->authorize('view', $novela);
        return view('novelas.show', compact('novela'));
    }

    /**
     * Muestra el formulario para editar una novela.
     */
    public function edit(Novela $novela)
    {
        $this->authorize('update', $novela);
        $generos = Genero::all();
        $novelaGeneros = $novela->generos->pluck('id')->toArray();
        return view('novelas.edit', compact('novela', 'generos', 'novelaGeneros'));
    }

    /**
     * Actualiza una novela en la base de datos.
     */
    public function update(Request $request, Novela $novela)
    {
        $this->authorize('update', $novela);

        $request->validate([
            'titulo' => 'required|max:255',
            'sinopsis' => 'required',
            'autor' => 'required|max:255',
            'genero_id' => 'required|exists:generos,id',
            'imagen_portada' => 'nullable|image|max:2048',
        ]);

        $novela->titulo = $request->titulo;
        $novela->sinopsis = $request->sinopsis;
        $novela->autor = $request->autor;
        $novela->publicada = $request->has('publicada');

        if ($request->hasFile('imagen_portada')) {
            // Eliminar imagen anterior si existe
            if ($novela->imagen_portada) {
                Storage::disk('public')->delete($novela->imagen_portada);
            }
            $path = $request->file('imagen_portada')->store('portadas', 'public');
            $novela->imagen_portada = $path;
        }

        $novela->save();

        // Sincronizar géneros (un solo género)
        if ($request->has('genero_id')) {
            $novela->generos()->sync([$request->genero_id]);
        } else {
            $novela->generos()->detach();
        }

        return redirect()->route('novelas.show', $novela)
            ->with('success', 'Novela actualizada con éxito.');
    }

    /**
     * Elimina una novela de la base de datos.
     */
    public function destroy(Novela $novela)
    {
        $this->authorize('delete', $novela);

        // Eliminar imagen de portada si existe
        if ($novela->imagen_portada) {
            Storage::disk('public')->delete($novela->imagen_portada);
        }

        $novela->delete();

        return redirect()->route('novelas.index')
            ->with('success', 'Novela eliminada con éxito.');
    }
}
