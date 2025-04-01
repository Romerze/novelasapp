<?php

namespace App\Http\Controllers;

use App\Models\Novela;
use App\Models\Capitulo;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal del usuario.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Obtener estadísticas para el usuario
        $totalNovelas = $user->novelas()->count();
        $novelasPublicadas = $user->novelas()->where('publicada', true)->count();
        $totalCapitulos = Capitulo::whereHas('novela', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        $totalVisitas = $user->novelas()->sum('visitas');
        
        // Obtener las últimas 5 novelas del usuario
        $ultimasNovelas = $user->novelas()->latest()->take(5)->get();
        
        // Obtener los últimos 5 capítulos del usuario
        $ultimosCapitulos = Capitulo::whereHas('novela', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->take(5)->get();
        
        return view('dashboard.index', compact(
            'totalNovelas', 
            'novelasPublicadas', 
            'totalCapitulos', 
            'totalVisitas', 
            'ultimasNovelas', 
            'ultimosCapitulos'
        ));
    }
    
    /**
     * Muestra el panel de administración (solo para administradores).
     */
    public function admin()
    {
        // Verificar si el usuario es administrador
        if (!Auth::user()->isAdmin) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        
        // Estadísticas generales del sistema
        $totalUsuarios = \App\Models\User::count();
        $totalNovelas = Novela::count();
        $totalCapitulos = Capitulo::count();
        $totalGeneros = Genero::count();
        $totalVisitasSistema = Novela::sum('visitas') + Capitulo::sum('visitas');
        
        // Obtener las 5 novelas más populares
        $novelasPopulares = Novela::where('publicada', true)
            ->orderBy('visitas', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard.admin', compact(
            'totalUsuarios',
            'totalNovelas',
            'totalCapitulos',
            'totalGeneros',
            'totalVisitasSistema',
            'novelasPopulares'
        ));
    }
}
