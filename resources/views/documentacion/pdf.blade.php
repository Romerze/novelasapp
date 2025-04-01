<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación NovelasApp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #4338ca;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4338ca;
        }
        h2 {
            color: #4338ca;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        h3 {
            color: #4f46e5;
            font-size: 18px;
            margin-top: 25px;
            margin-bottom: 10px;
        }
        .stats {
            margin: 20px 0;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .stats-item {
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 10px;
        }
        td {
            padding: 8px 10px;
        }
        code {
            font-family: Consolas, Monaco, monospace;
            background-color: #f5f5f5;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 14px;
        }
        ul {
            margin-top: 5px;
        }
        li {
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .cover {
            text-align: center;
            margin-bottom: 50px;
        }
        .cover h1 {
            font-size: 28px;
            border: none;
        }
        .cover p {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Portada -->
        <div class="cover">
            <h1>DOCUMENTACIÓN TÉCNICA Y FUNCIONAL</h1>
            <h2>NovelasApp</h2>
            <p>Plataforma de gestión y lectura de novelas</p>
            <p>Versión 1.0</p>
            <p>Fecha de generación: {{ $fechaGeneracion }}</p>
        </div>
        
        <div class="page-break"></div>
        
        <!-- Índice -->
        <h1>Índice de Contenidos</h1>
        <ul>
            <li>1. Introducción</li>
            <li>2. Estadísticas del Sistema</li>
            <li>3. Arquitectura</li>
            <li>4. Modelos y Relaciones</li>
            <li>5. Controladores</li>
            <li>6. Vistas</li>
            <li>7. Rutas</li>
            <li>8. Funcionalidades Principales</li>
            <li>9. Sistema de Autenticación</li>
            <li>10. Almacenamiento de Imágenes</li>
        </ul>
        
        <div class="page-break"></div>
        
        <!-- 1. Introducción -->
        <div class="section">
            <h1>1. Introducción</h1>
            <p>NovelasApp es una plataforma desarrollada en Laravel que permite a los usuarios crear, leer y gestionar novelas y capítulos. El sistema facilita la organización de novelas por géneros y permite a los autores publicar sus obras mientras los lectores pueden seguir sus novelas favoritas.</p>
            
            <h3>Objetivos del Sistema</h3>
            <ul>
                <li>Proporcionar una plataforma fácil de usar para escritores y lectores</li>
                <li>Permitir la gestión de novelas y capítulos</li>
                <li>Facilitar la categorización de obras por géneros</li>
                <li>Ofrecer interacción básica con los contenidos (guardar capítulos, dar "me gusta")</li>
                <li>Proporcionar estadísticas de lectura</li>
            </ul>
        </div>
        
        <!-- 2. Estadísticas -->
        <div class="section">
            <h1>2. Estadísticas del Sistema</h1>
            <div class="stats">
                <div class="stats-item">Total de Usuarios: <strong>{{ $totalUsuarios }}</strong></div>
                <div class="stats-item">Total de Novelas: <strong>{{ $totalNovelas }}</strong></div>
                <div class="stats-item">Total de Capítulos: <strong>{{ $totalCapitulos }}</strong></div>
                <div class="stats-item">Total de Géneros: <strong>{{ $totalGeneros }}</strong></div>
            </div>
        </div>
        
        <div class="page-break"></div>
        
        <!-- 3. Arquitectura -->
        <div class="section">
            <h1>3. Arquitectura</h1>
            <p>NovelasApp está construido utilizando el framework Laravel 10, siguiendo el patrón arquitectónico Modelo-Vista-Controlador (MVC).</p>
            
            <h3>Entorno Técnico</h3>
            <ul>
                <li><strong>Backend:</strong> PHP 8.1+, Laravel 10.x</li>
                <li><strong>Base de Datos:</strong> MySQL</li>
                <li><strong>Frontend:</strong> Blade, TailwindCSS, Alpine.js</li>
                <li><strong>Editor Rich Text:</strong> TinyMCE 6.4.2</li>
                <li><strong>Autenticación:</strong> Laravel Breeze</li>
            </ul>
            
            <h3>Estructura de Directorios</h3>
            <p>La aplicación sigue la estructura estándar de Laravel con algunas personalizaciones:</p>
            <ul>
                <li><code>app/Http/Controllers</code> - Controladores separados por funcionalidad</li>
                <li><code>app/Models</code> - Modelos de datos</li>
                <li><code>resources/views</code> - Vistas organizadas por secciones</li>
                <li><code>public/storage/novelasimagenes</code> - Almacenamiento de imágenes subidas</li>
                <li><code>routes/web.php</code> - Definición de rutas</li>
            </ul>
        </div>
        
        <!-- 4. Modelos y Relaciones -->
        <div class="section">
            <h1>4. Modelos y Relaciones</h1>
            
            <h3>User</h3>
            <p>Modelo de usuario que extiende de Laravel Breeze con algunos campos adicionales.</p>
            <p>Relaciones:</p>
            <ul>
                <li><code>novelas()</code> - Un usuario puede tener muchas novelas</li>
            </ul>
            
            <h3>Novela</h3>
            <p>Representa una obra literaria con múltiples capítulos.</p>
            <p>Relaciones:</p>
            <ul>
                <li><code>user()</code> - Pertenece a un usuario (autor)</li>
                <li><code>capitulos()</code> - Tiene muchos capítulos</li>
                <li><code>generos()</code> - Relación muchos a muchos con géneros</li>
            </ul>
            
            <h3>Capitulo</h3>
            <p>Representa un capítulo individual de una novela.</p>
            <p>Relaciones:</p>
            <ul>
                <li><code>novela()</code> - Pertenece a una novela</li>
                <li><code>imagenes()</code> - Tiene muchas imágenes</li>
                <li><code>usuariosConLike()</code> - Usuarios que han dado "me gusta"</li>
                <li><code>usuariosQueGuardaron()</code> - Usuarios que han guardado el capítulo</li>
            </ul>
            
            <h3>Genero</h3>
            <p>Representa una categoría o género literario.</p>
            <p>Relaciones:</p>
            <ul>
                <li><code>novelas()</code> - Relación muchos a muchos con novelas</li>
            </ul>
            
            <h3>CapituloImagen</h3>
            <p>Almacena referencias a imágenes utilizadas en los capítulos.</p>
            
            <h3>CapituloLike y CapituloGuardado</h3>
            <p>Modelos pivot para gestionar las interacciones de los usuarios con los capítulos.</p>
        </div>
        
        <div class="page-break"></div>
        
        <!-- 5. Controladores -->
        <div class="section">
            <h1>5. Controladores</h1>
            
            <h3>NovelaController</h3>
            <p>Gestiona las operaciones CRUD para las novelas:</p>
            <ul>
                <li><code>index()</code> - Listar novelas</li>
                <li><code>create()</code> - Mostrar formulario de creación</li>
                <li><code>store()</code> - Almacenar nueva novela</li>
                <li><code>show()</code> - Mostrar detalles de una novela</li>
                <li><code>edit()</code> - Mostrar formulario de edición</li>
                <li><code>update()</code> - Actualizar una novela</li>
                <li><code>destroy()</code> - Eliminar una novela</li>
            </ul>
            
            <h3>CapituloController</h3>
            <p>Gestiona las operaciones CRUD para los capítulos de novelas:</p>
            <ul>
                <li><code>index()</code> - Listar capítulos de una novela</li>
                <li><code>create()</code> - Mostrar formulario de creación</li>
                <li><code>store()</code> - Almacenar nuevo capítulo</li>
                <li><code>show()</code> - Mostrar un capítulo</li>
                <li><code>edit()</code> - Mostrar formulario de edición</li>
                <li><code>update()</code> - Actualizar un capítulo</li>
                <li><code>destroy()</code> - Eliminar un capítulo</li>
            </ul>
            
            <h3>CapituloImagenController</h3>
            <p>Gestiona la subida y eliminación de imágenes en los capítulos:</p>
            <ul>
                <li><code>store()</code> - Subir una nueva imagen</li>
                <li><code>destroy()</code> - Eliminar una imagen</li>
            </ul>
            
            <h3>CapituloInteraccionController</h3>
            <p>Gestiona las interacciones de los usuarios con los capítulos:</p>
            <ul>
                <li><code>toggleLike()</code> - Dar/quitar "me gusta" a un capítulo</li>
                <li><code>toggleGuardar()</code> - Guardar/dejar de guardar un capítulo</li>
            </ul>
            
            <h3>GeneroController</h3>
            <p>Gestiona las operaciones CRUD para los géneros literarios</p>
            
            <h3>PublicoController</h3>
            <p>Gestiona las vistas públicas de la aplicación:</p>
            <ul>
                <li><code>inicio()</code> - Página de inicio</li>
                <li><code>mostrarNovela()</code> - Mostrar una novela al público</li>
                <li><code>mostrarCapitulo()</code> - Mostrar un capítulo al público</li>
                <li><code>mostrarGenero()</code> - Mostrar novelas de un género</li>
            </ul>
        </div>
        
        <div class="page-break"></div>
        
        <!-- 6. Vistas -->
        <div class="section">
            <h1>6. Vistas</h1>
            <p>El sistema utiliza Blade como motor de plantillas y TailwindCSS para los estilos. Las vistas están organizadas en directorios según su funcionalidad:</p>
            
            <h3>Estructura principal</h3>
            <ul>
                <li><code>layouts/</code> - Plantillas base</li>
                <li><code>novelas/</code> - Vistas para la gestión de novelas</li>
                <li><code>capitulos/</code> - Vistas para la gestión de capítulos</li>
                <li><code>generos/</code> - Vistas para la gestión de géneros</li>
                <li><code>publico/</code> - Vistas para la parte pública</li>
                <li><code>auth/</code> - Vistas para autenticación (modificadas de Laravel Breeze)</li>
                <li><code>profile/</code> - Vistas para la gestión del perfil</li>
            </ul>
            
            <h3>Componentes destacados</h3>
            <ul>
                <li>Editor TinyMCE para contenido enriquecido en la creación/edición de capítulos</li>
                <li>Sistema de subida de imágenes integrado en el editor</li>
                <li>Visualización de contenido HTML en los capítulos</li>
                <li>Interfaces de usuario adaptativas (responsive)</li>
            </ul>
        </div>
        
        <!-- 7. Rutas -->
        <div class="section">
            <h1>7. Rutas</h1>
            <p>Las rutas están definidas en <code>routes/web.php</code> y están organizadas en grupos según su acceso:</p>
            
            <h3>Rutas públicas</h3>
            <ul>
                <li><code>/</code> - Página de inicio</li>
                <li><code>/public/novelas/{novela}</code> - Detalles de una novela</li>
                <li><code>/public/novelas/{novela}/capitulos/{capitulo}</code> - Ver un capítulo</li>
                <li><code>/public/generos/{genero}</code> - Ver novelas de un género</li>
            </ul>
            
            <h3>Rutas protegidas (requieren autenticación)</h3>
            <ul>
                <li><code>/dashboard</code> - Panel principal del usuario</li>
                <li><code>/novelas</code> - Gestión de novelas</li>
                <li><code>/novelas/{novela}/capitulos</code> - Gestión de capítulos</li>
                <li><code>/profile</code> - Gestión del perfil</li>
            </ul>
            
            <h3>Rutas específicas</h3>
            <p>Importante: Las rutas para los capítulos están correctamente anidadas bajo novelas, utilizando notación de rutas como:</p>
            <code>novelas.capitulos.index</code>, <code>novelas.capitulos.show</code>, etc.
        </div>
        
        <div class="page-break"></div>
        
        <!-- 8. Funcionalidades -->
        <div class="section">
            <h1>8. Funcionalidades Principales</h1>
            
            <h3>Sistema de Novelas</h3>
            <ul>
                <li>Creación y edición de novelas con título, descripción, portada y géneros</li>
                <li>Gestión de capítulos asociados a cada novela</li>
                <li>Estadísticas de lectura (visitas)</li>
            </ul>
            
            <h3>Sistema de Capítulos</h3>
            <ul>
                <li>Editor de texto enriquecido (TinyMCE) para el contenido</li>
                <li>Soporte para la inserción de imágenes</li>
                <li>Numeración automática</li>
                <li>Estado de publicación (publicado/borrador)</li>
                <li>Navegación entre capítulos (anterior/siguiente)</li>
            </ul>
            
            <h3>Sistema de Interacción</h3>
            <ul>
                <li>"Me gusta" en capítulos</li>
                <li>Guardar capítulos para lectura posterior</li>
                <li>Ver historial de capítulos guardados</li>
            </ul>
            
            <h3>Sistema de Géneros</h3>
            <ul>
                <li>Categorización de novelas por géneros</li>
                <li>Exploración de novelas por género</li>
            </ul>
        </div>
        
        <!-- 9. Autenticación -->
        <div class="section">
            <h1>9. Sistema de Autenticación</h1>
            <p>El sistema utiliza Laravel Breeze para la autenticación básica, con algunas personalizaciones:</p>
            
            <h3>Características</h3>
            <ul>
                <li>Registro de usuarios</li>
                <li>Inicio de sesión</li>
                <li>Recuperación de contraseña</li>
                <li>Edición de perfil</li>
                <li>Verificación de correo electrónico (opcional)</li>
            </ul>
            
            <h3>Roles</h3>
            <ul>
                <li><strong>Usuarios normales:</strong> Pueden crear y gestionar sus propias novelas</li>
                <li><strong>Administradores:</strong> Tienen acceso a funcionalidades adicionales, como la gestión de géneros</li>
            </ul>
            
            <h3>Políticas de autorización</h3>
            <p>Se utilizan políticas de Laravel para restringir acciones:</p>
            <ul>
                <li>Un usuario solo puede editar sus propias novelas</li>
                <li>Los capítulos solo pueden ser editados por el autor de la novela</li>
                <li>Los administradores pueden gestionar todos los recursos</li>
            </ul>
        </div>
        
        <!-- 10. Almacenamiento -->
        <div class="section">
            <h1>10. Almacenamiento de Imágenes</h1>
            <p>El sistema permite subir imágenes para las portadas de novelas y dentro del contenido de los capítulos:</p>
            
            <h3>Implementación</h3>
            <ul>
                <li>Utiliza el sistema de almacenamiento de Laravel (Storage Facade)</li>
                <li>Las imágenes se almacenan en <code>public/storage/novelasimagenes</code></li>
                <li>TinyMCE se integra con un endpoint personalizado para la subida de imágenes</li>
                <li>La subida de imágenes se gestiona mediante XMLHttpRequest con CSRF protection</li>
            </ul>
            
            <h3>Seguridad</h3>
            <ul>
                <li>Validación de tipos de archivos permitidos</li>
                <li>Comprobación de permisos antes de almacenar</li>
                <li>Protección contra CSRF en todas las operaciones</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>Documentación generada automáticamente - NovelasApp v1.0</p>
            <p>{{ $fechaGeneracion }}</p>
        </div>
    </div>
</body>
</html>
