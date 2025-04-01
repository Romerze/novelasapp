<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Novela;
use App\Models\Capitulo;
use App\Models\Genero;
use App\Models\User;
use Illuminate\Support\Facades\File;

class DocumentacionController extends Controller
{
    /**
     * Genera y devuelve un PDF con la documentación del sistema
     * @return \Illuminate\Http\Response
     */
    public function generarPDF()
    {
        // Recopilar datos para la documentación
        $totalUsuarios = 0;
        $totalNovelas = 0;
        $totalCapitulos = 0;
        $totalGeneros = 0;
        
        $novelas = [];
        $generos = [];
        
        try {
            $totalUsuarios = User::count() ?: 0;
            $totalNovelas = Novela::count() ?: 0;
            $totalCapitulos = Capitulo::count() ?: 0;
            $totalGeneros = Genero::count() ?: 0;
            
            $novelas = Novela::with('generos')->take(5)->get();
            $generos = Genero::all();
        } catch (\Exception $e) {
            // Algunas tablas podrían no existir aún
        }
        
        // Fecha de generación
        $fechaGeneracion = now()->format('d/m/Y H:i:s');
        
        // Generar el PDF
        $pdf = PDF::loadView('documentacion.pdf', compact(
            'totalUsuarios',
            'totalNovelas',
            'totalCapitulos',
            'totalGeneros',
            'novelas',
            'generos',
            'fechaGeneracion'
        ));
        
        // Configurar el PDF
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        
        // Descargar el PDF
        return $pdf->download('NovelasApp-Documentacion.pdf');
    }
    
    /**
     * Crea un archivo PDF físico en el directorio público
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearArchivoPDF()
    {
        // Recopilar datos para la documentación
        $totalUsuarios = 0;
        $totalNovelas = 0;
        $totalCapitulos = 0;
        $totalGeneros = 0;
        
        $novelas = [];
        $generos = [];
        
        try {
            $totalUsuarios = User::count() ?: 0;
            $totalNovelas = Novela::count() ?: 0;
            $totalCapitulos = Capitulo::count() ?: 0;
            $totalGeneros = Genero::count() ?: 0;
            
            $novelas = Novela::with('generos')->take(5)->get();
            $generos = Genero::all();
        } catch (\Exception $e) {
            // Algunas tablas podrían no existir aún
        }
        
        // Fecha de generación
        $fechaGeneracion = now()->format('d/m/Y H:i:s');
        
        // Generar el PDF
        $pdf = PDF::loadView('documentacion.pdf', compact(
            'totalUsuarios',
            'totalNovelas',
            'totalCapitulos',
            'totalGeneros',
            'novelas',
            'generos',
            'fechaGeneracion'
        ));
        
        // Configurar el PDF
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        
        // Definir la ruta donde guardar el PDF
        $rutaDocumentacion = public_path('documentacion');
        
        // Crear el directorio si no existe
        if (!File::exists($rutaDocumentacion)) {
            File::makeDirectory($rutaDocumentacion, 0755, true);
        }
        
        // Guardar el PDF
        $pdf->save($rutaDocumentacion . '/NovelasApp-Documentacion.pdf');
        
        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('status', 'La documentación ha sido generada y guardada correctamente.');
    }
    
    /**
     * Genera documentación profesional mejorada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generarDocumentacionProfesional()
    {
        // Recopilar información del sistema
        $info = [
            'usuarios' => 0,
            'novelas' => 0,
            'capitulos' => 0,
            'generos' => 0,
            'novelas_recientes' => [],
            'generos_list' => [],
            'fecha' => now()->format('d/m/Y H:i:s')
        ];
        
        try {
            $info['usuarios'] = User::count() ?: 0;
            $info['novelas'] = Novela::count() ?: 0;
            $info['capitulos'] = Capitulo::count() ?: 0;
            $info['generos'] = Genero::count() ?: 0;
            
            $info['novelas_recientes'] = Novela::with('user', 'generos')
                ->latest()
                ->take(5)
                ->get();
                
            $info['generos_list'] = Genero::withCount('novelas')
                ->orderBy('novelas_count', 'desc')
                ->take(10)
                ->get();
        } catch (\Exception $e) {
            // Algunas tablas podrían no existir aún
        }
        
        // Generar el PDF
        $pdf = PDF::loadView('documentacion.pdf_profesional', [
            'info' => $info
        ]);
        
        // Configurar el PDF
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        
        // Definir la ruta donde guardar el PDF
        $rutaDocumentacion = public_path('documentacion');
        
        // Crear el directorio si no existe
        if (!File::exists($rutaDocumentacion)) {
            File::makeDirectory($rutaDocumentacion, 0755, true);
        }
        
        // Guardar el PDF
        $pdf->save($rutaDocumentacion . '/NovelasApp-Documentacion-Profesional.pdf');
        
        // También devolver para descarga
        return $pdf->download('NovelasApp-Documentacion-Profesional.pdf');
    }
}
