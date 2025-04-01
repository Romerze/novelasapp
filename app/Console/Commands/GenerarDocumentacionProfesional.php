<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class GenerarDocumentacionProfesional extends Command
{
    protected $signature = 'documentacion:profesional {ruta_destino?}';
    protected $description = 'Genera documentación profesional del sistema NovelasApp en formato PDF';

    public function handle()
    {
        $this->info('Generando documentación profesional...');

        // Leer el contenido Markdown si existe
        $contenidoTecnico = '';
        $contenidoFuncional = '';
        
        $rutaTecnica = base_path('docs/documentacion-tecnica.md');
        $rutaFuncional = base_path('docs/documentacion-funcional.md');
        
        if (File::exists($rutaTecnica)) {
            $contenidoTecnico = File::get($rutaTecnica);
        }
        
        if (File::exists($rutaFuncional)) {
            $contenidoFuncional = File::get($rutaFuncional);
        }

        // Fecha de generación
        $fechaGeneracion = now()->format('d/m/Y H:i:s');

        // Análisis del sistema - Obtener estadísticas
        $this->info('Analizando el sistema NovelasApp...');
        
        // Preparar el HTML para el PDF
        $html = view('documentacion.profesional', [
            'fechaGeneracion' => $fechaGeneracion,
            'contenidoTecnico' => $contenidoTecnico,
            'contenidoFuncional' => $contenidoFuncional
        ])->render();

        // Generar el PDF
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('defaultFont', 'Arial');

        // Determinar ruta destino
        $rutaDestino = $this->argument('ruta_destino') 
            ?? public_path('documentacion/NovelasApp-Documentacion-Profesional.pdf');

        // Crear directorio si no existe
        $directorioDestino = dirname($rutaDestino);
        if (!File::exists($directorioDestino)) {
            File::makeDirectory($directorioDestino, 0755, true);
        }

        // Guardar el PDF
        $pdf->save($rutaDestino);

        $this->info('Documentación profesional generada con éxito en: ' . $rutaDestino);
        
        return 0;
    }
}
