<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GeneroController extends Controller
{
    /**
     * Muestra un listado de géneros literarios.
     */
    public function index()
    {
        $generos = Genero::withCount('novelas')->orderBy('nombre')->paginate(20);
        return view('generos.index', compact('generos'));
    }

    /**
     * Muestra el formulario para crear un nuevo género.
     */
    public function create()
    {
        $this->authorize('create', Genero::class);
        return view('generos.create');
    }

    /**
     * Almacena un nuevo género en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Genero::class);

        $request->validate([
            'nombre' => 'required|max:255|unique:generos',
            'descripcion' => 'nullable',
        ]);

        $genero = new Genero([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $genero->save();

        return redirect()->route('generos.index')
            ->with('success', 'Género creado con éxito.');
    }

    /**
     * Muestra un género específico y las novelas asociadas.
     */
    public function show(Genero $genero)
    {
        $novelas = $genero->novelas()->where('publicada', true)->paginate(12);
        $otrosGeneros = Genero::where('id', '!=', $genero->id)->inRandomOrder()->limit(5)->get();
        return view('generos.show', compact('genero', 'novelas', 'otrosGeneros'));
    }

    /**
     * Muestra el formulario para editar un género.
     */
    public function edit(Genero $genero)
    {
        $this->authorize('update', $genero);
        return view('generos.edit', compact('genero'));
    }

    /**
     * Actualiza un género en la base de datos.
     */
    public function update(Request $request, Genero $genero)
    {
        $this->authorize('update', $genero);

        $request->validate([
            'nombre' => 'required|max:255|unique:generos,nombre,' . $genero->id,
            'descripcion' => 'nullable',
        ]);

        $genero->nombre = $request->nombre;
        $genero->descripcion = $request->descripcion;
        $genero->save();

        return redirect()->route('generos.index')
            ->with('success', 'Género actualizado con éxito.');
    }

    /**
     * Elimina un género de la base de datos.
     */
    public function destroy(Genero $genero)
    {
        $this->authorize('delete', $genero);

        // Comprobar si hay novelas asociadas antes de eliminar
        if ($genero->novelas()->count() > 0) {
            return redirect()->route('generos.index')
                ->with('error', 'No se puede eliminar este género porque hay novelas asociadas a él.');
        }

        $genero->delete();

        return redirect()->route('generos.index')
            ->with('success', 'Género eliminado con éxito.');
    }
}
