# NovelasApp - Plataforma de Gestión de Novelas

<p align="center">
  <img src="public/images/default-cover.svg" width="200" alt="NovelasApp Logo">
</p>

## Acerca de NovelasApp

NovelasApp es una plataforma web completa para la creación, publicación y lectura de novelas en línea, desarrollada con Laravel 10 y MySQL. El sistema permite a los escritores compartir sus obras por capítulos y a los lectores descubrir historias según sus géneros preferidos.

### Características Principales

- **Gestión de Novelas**: Creación, edición y eliminación de novelas con portadas personalizadas
- **Sistema de Capítulos**: Organización de contenido por capítulos con editor de texto enriquecido
- **Categorización por Géneros**: Clasificación de novelas mediante géneros literarios
- **Interacción de Usuarios**: Sistema de likes y guardado de capítulos favoritos
- **Perfiles de Usuario**: Gestión de perfiles para escritores y lectores
- **Panel Administrativo**: Control total del contenido del sitio para administradores
- **Autenticación Robusta**: Sistema completo de registro y login mediante Laravel Breeze
- **Diseño Responsivo**: Interfaz adaptable a diferentes dispositivos

## Tecnologías Utilizadas

- **Backend**: PHP 8.1, Laravel 10
- **Frontend**: HTML5, CSS3, JavaScript, TailwindCSS, Alpine.js
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Breeze
- **Almacenamiento**: Sistema de archivos local para imágenes

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- MySQL
- Node.js y NPM
- Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/Romerze/novelasapp.git
cd novelasapp
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node.js:
```bash
npm install
```

4. Configurar el archivo .env:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la conexión a la base de datos MySQL en .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=novelasapp
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. Ejecutar migraciones:
```bash
php artisan migrate
```

7. Compilar assets:
```bash
npm run build
```

8. Iniciar el servidor:
```bash
php artisan serve
```

9. Acceder a la aplicación en http://localhost:8000

## Estructura del Proyecto

La aplicación sigue una arquitectura MVC (Modelo-Vista-Controlador):

- **Modelos**: Representan las entidades del sistema (Novela, Capitulo, Genero, User)
- **Vistas**: Plantillas Blade organizadas por secciones
- **Controladores**: Gestionan la lógica de negocio por entidad

### Rutas Principales

El sistema utiliza rutas anidadas para representar la relación jerárquica entre recursos:

- `/novelas`: Gestión de novelas
- `/novelas/{novela}/capitulos`: Gestión de capítulos asociados a una novela
- `/generos`: Gestión de géneros literarios
- `/dashboard`: Panel de control para usuarios registrados

## Documentación

El sistema incluye documentación técnica y funcional completa que puede generarse como PDF o Word:

```bash
php artisan documentacion:profesional
```

La documentación se guardará en `public/documentacion/NovelasApp-Documentacion-Profesional.pdf`

## Créditos

Desarrollado por Romerze

## Licencia

Este proyecto está licenciado bajo [MIT license](https://opensource.org/licenses/MIT).
