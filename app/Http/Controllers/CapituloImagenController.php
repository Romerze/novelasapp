<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\CapituloImagen;
use App\Models\Novela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CapituloImagenController extends Controller
{
    /**
     * Almacena una nueva imagen para el capítulo.
     */
    public function store(Request $request, Novela $novela, Capitulo $capitulo) {
        // Desactivamos todas las validaciones temporalmente para diagnosticar
        try {
            // Verificamos que haya un archivo
            if (!$request->hasFile('imagen')) {
                return response()->json(['error' => 'No se encontró archivo de imagen'], 400);
            }
            
            // Obtenemos el archivo
            $file = $request->file('imagen');
            
            // Guardamos la imagen en storage/app/public/capitulos/imagenes
            $path = $file->store('capitulos/imagenes', 'public');
            
            // Creamos el registro en la base de datos
            $imagen = new CapituloImagen();
            $imagen->capitulo_id = $capitulo->id;
            $imagen->ruta = $path;
            $imagen->nombre_original = $file->getClientOriginalName();
            $imagen->tipo_mime = $file->getMimeType();
            $imagen->posicion = 1; // Posición por defecto
            $imagen->save();
            
            // Generamos la URL completa
            $url = asset('storage/' . $path);
            
            // Devolvemos la respuesta
            return response()->json([
                'location' => $url
            ]);
            
        } catch (\Exception $e) {
            // Registramos el error para depuración
            Log::error('Error al subir imagen: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            // Devolvemos una respuesta de error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Elimina una imagen del capítulo.
     */
    public function destroy(Novela $novela, Capitulo $capitulo, CapituloImagen $imagen) {
        try {
            // Verificar que la imagen pertenezca al capítulo
            if ($imagen->capitulo_id !== $capitulo->id) {
                abort(404);
            }

            // Eliminar el archivo
            if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
                Storage::disk('public')->delete($imagen->ruta);
            }

            // Eliminar el registro
            $imagen->delete();

            return redirect()->back()->with('success', 'Imagen eliminada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar imagen: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar la imagen');
        }
    }

    /**
     * Obtener listado de imágenes del capítulo (para AJAX)
     */
    public function index(Novela $novela, Capitulo $capitulo)
    {
        $this->authorize('view', $novela);

        if ($capitulo->novela_id !== $novela->id) {
            abort(404);
        }

        $imagenes = $capitulo->imagenes()->get()->map(function ($imagen) {
            return [
                'id' => $imagen->id,
                'url' => $imagen->url,
                'nombre' => $imagen->nombre_original,
                'descripcion' => $imagen->descripcion,
                'posicion' => $imagen->posicion,
            ];
        });

        return response()->json(['imagenes' => $imagenes]);
    }
}
