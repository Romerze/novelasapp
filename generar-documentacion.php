<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/app.php';

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

// Leer el contenido Markdown
$contenidoTecnico = File::get(__DIR__ . '/docs/documentacion-tecnica.md');
$contenidoFuncional = File::get(__DIR__ . '/docs/documentacion-funcional.md');

// Fecha de generación
$fechaGeneracion = date('d/m/Y H:i:s');

// Preparar el HTML para el PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .cover-page {
            text-align: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .cover-title {
            font-size: 32pt;
            font-weight: bold;
            color: #4338CA;
            margin-bottom: 20px;
        }
        .cover-subtitle {
            font-size: 18pt;
            margin-bottom: 50px;
            color: #6366F1;
        }
        .cover-date {
            font-size: 14pt;
            margin-top: 80px;
            color: #6B7280;
        }
        .page-break {
            page-break-after: always;
        }
        h1 {
            font-size: 24pt;
            color: #4338CA;
            margin-top: 40px;
            border-bottom: 2px solid #4338CA;
            padding-bottom: 5px;
        }
        h2 {
            font-size: 18pt;
            color: #6366F1;
            margin-top: 30px;
        }
        h3 {
            font-size: 14pt;
            color: #4F46E5;
            margin-top: 20px;
        }
        h4 {
            font-size: 12pt;
            color: #4F46E5;
            margin-top: 15px;
            font-style: italic;
        }
        p {
            margin-bottom: 10px;
            text-align: justify;
        }
        ul, ol {
            margin-bottom: 10px;
            margin-left: 20px;
        }
        .footer {
            position: fixed;
            bottom: 30px;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            color: #6B7280;
        }
        .toc-title {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #4338CA;
        }
        .toc-item {
            margin-bottom: 5px;
        }
        .toc-section {
            font-weight: bold;
            color: #4F46E5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #D1D5DB;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #EEF2FF;
            font-weight: bold;
            color: #4338CA;
        }
        tr:nth-child(even) {
            background-color: #F9FAFB;
        }
        code {
            font-family: "Courier New", monospace;
            background-color: #F3F4F6;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 10pt;
        }
        .code-block {
            background-color: #F3F4F6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-family: "Courier New", monospace;
            font-size: 10pt;
            white-space: pre-wrap;
            overflow-x: auto;
        }
        .section-divider {
            border: none;
            border-top: 2px solid #4338CA;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Portada -->
    <div class="cover-page">
        <div class="cover-title">DOCUMENTACIÓN TÉCNICA Y FUNCIONAL</div>
        <div class="cover-subtitle">Sistema NovelasApp</div>
        <div style="margin-top: 40px;">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Ik0xMiAyQzYuNDggMiAyIDYuNDggMiAxMkMyIDE3LjUyIDYuNDggMjIgMTIgMjJDMTcuNTIgMjIgMjIgMTcuNTIgMjIgMTJDMjIgNi40OCAxNy41MiAyIDEyIDJaTTEyIDVDMTMuNjYgNSAxNSA2LjM0IDE1IDhDMTUgOS42NiAxMy42NiAxMSAxMiAxMUMxMC4zNCAxMSA5IDkuNjYgOSA4QzkgNi4zNCAxMC4zNCA1IDEyIDVaTTEyIDIwQzkuMTYgMjAgNi43MSAxOC4yIDUuNjkgMTYuNjdDNS42OSAxNS4wMSA5LjkgMTMuOSAxMiAxMy45QzE0LjA5IDEzLjkgMTguMzEgMTUuMDEgMTguMzEgMTYuNjdDMTcuMjggMTguMjUgMTQuODQgMjAgMTIgMjBaIiBmaWxsPSIjNDMzOENBIi8+PC9zdmc+" alt="Logo" height="100">
        </div>
        <div class="cover-date">Generado el: ' . $fechaGeneracion . '</div>
        <div class="cover-date">Versión 1.0</div>
    </div>
    
    <div class="page-break"></div>
    
    <!-- Índice de Contenidos -->
    <div class="toc-title">ÍNDICE DE CONTENIDOS</div>
    
    <div class="toc-item"><span class="toc-section">1. INTRODUCCIÓN</span></div>
    <div class="toc-item" style="margin-left: 20px;">1.1 Descripción General</div>
    <div class="toc-item" style="margin-left: 20px;">1.2 Propósito y Alcance</div>
    <div class="toc-item" style="margin-left: 20px;">1.3 Objetivos del Sistema</div>
    
    <div class="toc-item"><span class="toc-section">2. DOCUMENTACIÓN FUNCIONAL</span></div>
    <div class="toc-item" style="margin-left: 20px;">2.1 Módulo de Usuarios</div>
    <div class="toc-item" style="margin-left: 20px;">2.2 Módulo de Novelas</div>
    <div class="toc-item" style="margin-left: 20px;">2.3 Módulo de Capítulos</div>
    <div class="toc-item" style="margin-left: 20px;">2.4 Módulo de Géneros</div>
    <div class="toc-item" style="margin-left: 20px;">2.5 Módulo de Interacción</div>
    <div class="toc-item" style="margin-left: 20px;">2.6 Módulo de Imágenes</div>
    <div class="toc-item" style="margin-left: 20px;">2.7 Perfiles de Usuario</div>
    <div class="toc-item" style="margin-left: 20px;">2.8 Flujos de Trabajo</div>
    <div class="toc-item" style="margin-left: 20px;">2.9 Interfaces de Usuario</div>
    <div class="toc-item" style="margin-left: 20px;">2.10 Requisitos No Funcionales</div>
    
    <div class="toc-item"><span class="toc-section">3. DOCUMENTACIÓN TÉCNICA</span></div>
    <div class="toc-item" style="margin-left: 20px;">3.1 Arquitectura del Sistema</div>
    <div class="toc-item" style="margin-left: 20px;">3.2 Stack Tecnológico</div>
    <div class="toc-item" style="margin-left: 20px;">3.3 Modelos y Base de Datos</div>
    <div class="toc-item" style="margin-left: 20px;">3.4 Estructura del Código</div>
    <div class="toc-item" style="margin-left: 20px;">3.5 API y Puntos de Entrada</div>
    <div class="toc-item" style="margin-left: 20px;">3.6 Seguridad</div>
    <div class="toc-item" style="margin-left: 20px;">3.7 Implementación de Características</div>
    <div class="toc-item" style="margin-left: 20px;">3.8 Configuración y Despliegue</div>
    
    <div class="page-break"></div>
    
    <!-- Introducción -->
    <h1>1. INTRODUCCIÓN</h1>
    
    <h2>1.1 Descripción General</h2>
    <p>NovelasApp es una plataforma web especializada para la creación, publicación y lectura de novelas en línea. El sistema permite a los escritores compartir sus obras por capítulos y a los lectores descubrir y seguir historias según sus géneros preferidos.</p>
    
    <h2>1.2 Propósito y Alcance</h2>
    <p>El propósito principal de NovelasApp es proporcionar un espacio donde:</p>
    <ul>
        <li>Los escritores puedan publicar sus novelas capítulo a capítulo</li>
        <li>Los lectores puedan descubrir y disfrutar de nuevas historias</li>
        <li>Se fomente la comunidad literaria mediante interacciones básicas</li>
        <li>Se mantenga un catálogo organizado por géneros literarios</li>
    </ul>
    
    <h2>1.3 Objetivos del Sistema</h2>
    <ul>
        <li>Facilitar la creación y publicación de contenido literario</li>
        <li>Ofrecer una experiencia de lectura limpia y agradable</li>
        <li>Proporcionar herramientas para organizar y gestionar novelas</li>
        <li>Permitir la interacción básica entre usuarios y contenidos</li>
        <li>Establecer un sistema de categorización eficiente</li>
    </ul>
    
    <div class="page-break"></div>
    
    <!-- Contenido Funcional -->
    <h1>2. DOCUMENTACIÓN FUNCIONAL</h1>
    
    ' . nl2br(htmlspecialchars($contenidoFuncional)) . '
    
    <div class="page-break"></div>
    
    <!-- Contenido Técnico -->
    <h1>3. DOCUMENTACIÓN TÉCNICA</h1>
    
    ' . nl2br(htmlspecialchars($contenidoTecnico)) . '
    
    <div class="page-break"></div>
    
    <!-- Anexos -->
    <h1>ANEXOS</h1>
    
    <h2>A.1 Glosario de Términos</h2>
    <table>
        <tr>
            <th>Término</th>
            <th>Definición</th>
        </tr>
        <tr>
            <td>Novela</td>
            <td>Obra literaria narrativa de cierta extensión, compuesta por capítulos.</td>
        </tr>
        <tr>
            <td>Capítulo</td>
            <td>División de una novela que agrupa un conjunto específico de eventos dentro de la misma.</td>
        </tr>
        <tr>
            <td>Género</td>
            <td>Categoría que clasifica las novelas según su temática y características.</td>
        </tr>
        <tr>
            <td>Laravel</td>
            <td>Framework de PHP utilizado para el desarrollo de la aplicación.</td>
        </tr>
        <tr>
            <td>Middleware</td>
            <td>Mecanismo de filtrado de peticiones HTTP en Laravel.</td>
        </tr>
        <tr>
            <td>Blade</td>
            <td>Motor de plantillas de Laravel utilizado para las vistas.</td>
        </tr>
    </table>
    
    <h2>A.2 Acerca de la Documentación</h2>
    <p>Este documento ha sido generado automáticamente mediante el sistema de documentación integrado en NovelasApp. La información presentada corresponde al estado actual del sistema en el momento de su generación.</p>
    <p>Para cualquier actualización o modificación, contacte con el administrador del sistema.</p>
    
    <!-- Pie de página -->
    <div class="footer">
        NovelasApp - Documentación Técnica y Funcional - Página {PAGE_NUM} de {PAGE_COUNT}
    </div>
</body>
</html>
';

// Generar el PDF con DomPDF
$pdf = PDF::loadHTML($html);
$pdf->setPaper('a4', 'portrait');
$pdf->setOption('isRemoteEnabled', true);
$pdf->setOption('isHtml5ParserEnabled', true);
$pdf->setOption('defaultFont', 'Arial');

// Guardar el archivo
$rutaArchivo = __DIR__ . '/public/documentacion/NovelasApp-Documentacion-Profesional.pdf';

// Crear directorio si no existe
if (!File::exists(dirname($rutaArchivo))) {
    File::makeDirectory(dirname($rutaArchivo), 0755, true);
}

$pdf->save($rutaArchivo);

echo "Documentación generada con éxito en: " . $rutaArchivo;
