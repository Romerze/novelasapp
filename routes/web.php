<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NovelaController;
use App\Http\Controllers\CapituloController;
use App\Http\Controllers\CapituloImagenController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\CapituloInteraccionController;
use App\Http\Controllers\DocumentacionController;
use Illuminate\Support\Facades\Route;

// Ruta temporal para generar la documentación física
Route::get('/generar-doc-fisica', [DocumentacionController::class, 'crearArchivoPDF']);

// Rutas Públicas
Route::get('/', [PublicoController::class, 'inicio'])->name('inicio');
Route::get('/public/novelas', [PublicoController::class, 'todasLasNovelas'])->name('novelas.publico.index');
Route::get('/public/novelas/{novela}', [PublicoController::class, 'mostrarNovela'])->name('novelas.publico.show');
Route::get('/public/novelas/{novela}/capitulos/{capitulo}', [PublicoController::class, 'mostrarCapitulo'])->name('capitulos.publico.show');
Route::get('/public/generos', [PublicoController::class, 'todosLosGeneros'])->name('generos.publico.index');
Route::get('/public/generos/{genero}', [PublicoController::class, 'mostrarGenero'])->name('generos.publico.show');
Route::get('/public/buscar', [PublicoController::class, 'buscar'])->name('buscar');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Novelas (panel de control)
    Route::get('/novelas', [NovelaController::class, 'index'])->name('novelas.index');
    Route::get('/novelas/create', [NovelaController::class, 'create'])->name('novelas.create');
    Route::post('/novelas', [NovelaController::class, 'store'])->name('novelas.store');
    Route::get('/novelas/{novela}', [NovelaController::class, 'show'])->name('novelas.show');
    Route::get('/novelas/{novela}/edit', [NovelaController::class, 'edit'])->name('novelas.edit');
    Route::put('/novelas/{novela}', [NovelaController::class, 'update'])->name('novelas.update');
    Route::delete('/novelas/{novela}', [NovelaController::class, 'destroy'])->name('novelas.destroy');
    
    // Capítulos (anidados dentro de novelas)
    Route::get('/novelas/{novela}/capitulos', [CapituloController::class, 'index'])->name('novelas.capitulos.index');
    Route::get('/novelas/{novela}/capitulos/create', [CapituloController::class, 'create'])->name('novelas.capitulos.create');
    Route::post('/novelas/{novela}/capitulos', [CapituloController::class, 'store'])->name('novelas.capitulos.store');
    Route::get('/novelas/{novela}/capitulos/{capitulo}', [CapituloController::class, 'show'])->name('novelas.capitulos.show');
    Route::get('/novelas/{novela}/capitulos/{capitulo}/edit', [CapituloController::class, 'edit'])->name('novelas.capitulos.edit');
    Route::put('/novelas/{novela}/capitulos/{capitulo}', [CapituloController::class, 'update'])->name('novelas.capitulos.update');
    Route::delete('/novelas/{novela}/capitulos/{capitulo}', [CapituloController::class, 'destroy'])->name('novelas.capitulos.destroy');
    
    // Imágenes de capítulos
    Route::get('/novelas/{novela}/capitulos/{capitulo}/imagenes', [CapituloImagenController::class, 'index'])->name('novelas.capitulos.imagenes.index');
    Route::post('/novelas/{novela}/capitulos/{capitulo}/imagenes', [CapituloImagenController::class, 'store'])->name('novelas.capitulos.imagenes.store');
    Route::delete('/novelas/{novela}/capitulos/{capitulo}/imagenes/{imagen}', [CapituloImagenController::class, 'destroy'])->name('novelas.capitulos.imagenes.destroy');

    // Géneros (panel de control)
    Route::get('/generos/admin', [GeneroController::class, 'index'])->name('generos.index');
    Route::get('/generos/create', [GeneroController::class, 'create'])->name('generos.create');
    Route::post('/generos', [GeneroController::class, 'store'])->name('generos.store');
    Route::get('/generos/{genero}', [GeneroController::class, 'show'])->name('generos.show');
    Route::get('/generos/{genero}/edit', [GeneroController::class, 'edit'])->name('generos.edit');
    Route::put('/generos/{genero}', [GeneroController::class, 'update'])->name('generos.update');
    Route::delete('/generos/{genero}', [GeneroController::class, 'destroy'])->name('generos.destroy');
    
    // Perfil
    Route::get('/profile/view', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Interacciones con capítulos (me gusta y guardar)
    Route::post('/capitulos/{capitulo}/like', [CapituloInteraccionController::class, 'toggleLike'])->name('capitulos.like');
    Route::post('/capitulos/{capitulo}/guardar', [CapituloInteraccionController::class, 'toggleGuardar'])->name('capitulos.guardar');
    Route::get('/mis-guardados', [CapituloInteraccionController::class, 'misCapitulosGuardados'])->name('capitulos.mis-guardados');
    
    // Documentación
    Route::get('/documentacion/pdf', [DocumentacionController::class, 'generarPDF'])->name('documentacion.pdf');
});

// Rutas de administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    // Aquí puedes agregar más rutas administrativas
});

// Rutas de autenticación
require __DIR__.'/auth.php';
