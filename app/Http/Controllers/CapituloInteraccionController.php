<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\CapituloLike;
use App\Models\CapituloGuardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CapituloInteraccionController extends Controller
{
    /**
     * Constructor que aplica el middleware de autenticación a todas las acciones.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dar "me gusta" o quitar "me gusta" a un capítulo.
     */
    public function toggleLike(Request $request, Capitulo $capitulo)
    {
        $userId = Auth::id();
        
        // Verificar si ya existe un "me gusta" para este usuario y capítulo
        $existingLike = CapituloLike::where('user_id', $userId)
            ->where('capitulo_id', $capitulo->id)
            ->first();
            
        if ($existingLike) {
            // Si ya existe, eliminar el "me gusta"
            $existingLike->delete();
            $liked = false;
        } else {
            // Si no existe, crear un nuevo "me gusta"
            CapituloLike::create([
                'user_id' => $userId,
                'capitulo_id' => $capitulo->id
            ]);
            $liked = true;
        }
        
        // Si es una solicitud AJAX, devolver JSON
        if ($request->ajax()) {
            return response()->json([
                'liked' => $liked,
                'count' => $capitulo->usuariosConLike()->count()
            ]);
        }
        
        // Si no es AJAX, redirigir de vuelta con un mensaje
        return back()->with('status', $liked 
            ? 'Has marcado este capítulo como "Me gusta"' 
            : 'Has quitado tu "Me gusta" de este capítulo');
    }
    
    /**
     * Guardar o quitar de guardados un capítulo.
     */
    public function toggleGuardar(Request $request, Capitulo $capitulo)
    {
        $userId = Auth::id();
        
        // Verificar si ya está guardado este capítulo para este usuario
        $existingGuardado = CapituloGuardado::where('user_id', $userId)
            ->where('capitulo_id', $capitulo->id)
            ->first();
            
        if ($existingGuardado) {
            // Si ya existe, eliminar el guardado
            $existingGuardado->delete();
            $guardado = false;
        } else {
            // Si no existe, guardar el capítulo
            CapituloGuardado::create([
                'user_id' => $userId,
                'capitulo_id' => $capitulo->id
            ]);
            $guardado = true;
        }
        
        // Si es una solicitud AJAX, devolver JSON
        if ($request->ajax()) {
            return response()->json([
                'guardado' => $guardado
            ]);
        }
        
        // Si no es AJAX, redirigir de vuelta con un mensaje
        return back()->with('status', $guardado 
            ? 'Has guardado este capítulo' 
            : 'Has quitado este capítulo de tus guardados');
    }
    
    /**
     * Mostrar todos los capítulos guardados por el usuario.
     */
    public function misCapitulosGuardados()
    {
        $user = Auth::user();
        $capitulosGuardados = $user->capitulosGuardados()
            ->with('novela')
            ->orderBy('capitulo_guardados.created_at', 'desc')
            ->paginate(15);
            
        return view('publico.capitulos.guardados', [
            'capitulos' => $capitulosGuardados
        ]);
    }
}
