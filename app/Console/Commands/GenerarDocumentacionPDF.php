<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Novela;
use App\Models\Capitulo;
use App\Models\Genero;
use App\Models\User;
use Illuminate\Support\Facades\File;

class GenerarDocumentacionPDF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documentacion:generar {ruta? : Ruta donde guardar el PDF}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera la documentación técnica y funcional del sistema en formato PDF';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generando documentación técnica y funcional...');

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
            $this->warn('Algunas tablas no existen aún. Generando documentación con datos mínimos.');
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
        
        // Determinar la ruta donde guardar el PDF
        $rutaDestino = $this->argument('ruta') ?: base_path();
        
        // Si la ruta destino es un directorio, usarlo como ruta base
        if (is_dir($rutaDestino)) {
            $rutaArchivo = $rutaDestino . DIRECTORY_SEPARATOR . 'NovelasApp-Documentacion.pdf';
        } else {
            // Usar la ruta completa especificada
            $rutaArchivo = $rutaDestino;
        }
        
        // Asegurar que la carpeta exista
        $directorio = dirname($rutaArchivo);
        if (!File::exists($directorio)) {
            File::makeDirectory($directorio, 0755, true);
        }
        
        // Guardar el PDF
        file_put_contents($rutaArchivo, $pdf->output());
        
        $this->info('Documentación generada correctamente en: ' . $rutaArchivo);
        
        return 0;
    }
}
