# Documentación Técnica - Sistema NovelasApp

## 1. Arquitectura del Sistema

### 1.1 Visión General

NovelasApp es una aplicación web desarrollada con Laravel que permite a los usuarios leer, escribir y compartir novelas online. La plataforma proporciona una interfaz intuitiva para los escritores, permitiéndoles publicar sus obras por capítulos, mientras los lectores pueden descubrir, guardar y dar me gusta a las novelas que les interesen.

### 1.2 Arquitectura Técnica

El sistema sigue una arquitectura Model-View-Controller (MVC) implementada a través del framework Laravel 10:

- **Capa de Presentación**: Implementada con Laravel Blade y TailwindCSS
- **Capa de Negocio**: Controladores Laravel organizados por funcionalidad
- **Capa de Datos**: Modelos Eloquent con relaciones definidas
- **Capa de Persistencia**: Base de datos MySQL para almacenamiento

#### Diagrama de Arquitectura

```
┌─────────────────────────────────────────────────────────┐
│                   Cliente (Navegador)                    │
└───────────────────────────┬─────────────────────────────┘
                            │
┌───────────────────────────▼─────────────────────────────┐
│                   Laravel Application                    │
│  ┌────────────┐    ┌────────────┐    ┌────────────┐     │
│  │    Views   │    │ Controllers│    │   Models   │     │
│  │  (Blade)   │◄───┤   (HTTP)   │◄───┤ (Eloquent) │     │
│  └────────────┘    └────────────┘    └─────┬──────┘     │
└─────────────────────────────────────────────┼───────────┘
                                              │
┌─────────────────────────────────────────────▼───────────┐
│                  MySQL Database                          │
└─────────────────────────────────────────────────────────┘
```

### 1.3 Stack Tecnológico

- **Backend**: PHP 8.1, Laravel 10
- **Frontend**: HTML5, CSS3, JavaScript, TailwindCSS, Alpine.js
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Breeze
- **Editor de Texto**: TinyMCE para edición de capítulos
- **Almacenamiento**: Sistema de archivos local para imágenes

## 2. Modelos y Base de Datos

### 2.1 Diagrama Entidad-Relación

```
┌───────────┐       ┌───────────┐       ┌───────────┐
│   Users   │       │  Novelas  │       │ Capitulos │
├───────────┤       ├───────────┤       ├───────────┤
│ id        │       │ id        │       │ id        │
│ name      │       │ titulo    │       │ titulo    │
│ email     │──1┬─<>│ user_id   │──1┬─<>│ novela_id │
│ password  │   │   │ descripcion│   │   │ contenido │
│ ...       │   │   │ portada   │   │   │ numero    │
└───────────┘   │   │ ...       │   │   │ ...       │
                │   └───────────┘   │   └───────────┘
                │         │         │         │
                │         │         │         │
                │         ▼         │         ▼
                │   ┌───────────┐   │   ┌───────────┐
                │   │ NovelaGenero   │   │CapituloImagen│
                │   ├───────────┤   │   ├───────────┤
                │   │ novela_id │   │   │capitulo_id│
                │   │ genero_id │   │   │  path     │
                │   └───────────┘   │   └───────────┘
                │         ▲         │
                │         │         │
                │   ┌───────────┐   │
                └──>│  Generos  │<──┘
                    ├───────────┤
                    │ id        │
                    │ nombre    │
                    │ ...       │
                    └───────────┘
```

### 2.2 Descripción de Tablas Principales

#### Users
Almacena información de usuarios, incluyendo credenciales de autenticación y datos personales.

#### Novelas
Contiene información sobre las novelas, incluyendo título, descripción y referencia al autor.

#### Capitulos
Almacena capítulos individuales asociados a cada novela, con su contenido y numeración.

#### Generos
Catálogo de géneros literarios disponibles para clasificar novelas.

#### Tablas Pivot
- **novela_genero**: Relación muchos a muchos entre novelas y géneros
- **capitulo_guardado**: Registro de capítulos guardados por usuarios
- **capitulo_like**: Registro de "me gusta" en capítulos

### 2.3 Relaciones Clave

- **Usuario → Novelas**: Un usuario puede tener muchas novelas (1:N)
- **Novela → Capítulos**: Una novela contiene muchos capítulos (1:N)
- **Novela ↔ Géneros**: Una novela puede tener múltiples géneros, y un género puede estar asociado a múltiples novelas (N:M)
- **Capítulo → Imágenes**: Un capítulo puede contener múltiples imágenes (1:N)

## 3. Estructura del Código

### 3.1 Organización de Directorios

```
novelas-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controladores de la aplicación
│   │   ├── Middleware/         # Middleware de autenticación y permisos
│   │   └── Requests/           # Validación de formularios
│   ├── Models/                 # Modelos Eloquent
│   └── Providers/              # Proveedores de servicios
├── config/                     # Configuración de la aplicación
├── database/
│   ├── migrations/             # Migraciones de la base de datos
│   └── seeders/                # Datos iniciales
├── public/                     # Archivos accesibles públicamente
│   └── storage/                # Imágenes y archivos subidos
├── resources/
│   ├── css/                    # Estilos CSS/TailwindCSS
│   ├── js/                     # Código JavaScript
│   └── views/                  # Vistas Blade
│       ├── auth/               # Vistas de autenticación
│       ├── layouts/            # Plantillas de diseño
│       ├── novelas/            # Vistas de novelas
│       ├── capitulos/          # Vistas de capítulos
│       └── publico/            # Vistas de acceso público
├── routes/                     # Definición de rutas
│   └── web.php                 # Rutas principales de la aplicación
└── storage/                    # Almacenamiento de la aplicación
```

### 3.2 Patrones de Diseño Implementados

- **Repository Pattern**: Abstracción de la capa de datos
- **Service Layer**: Lógica de negocio separada de los controladores
- **Factory Method**: Creación de modelos
- **Middleware**: Filtrado de peticiones HTTP

## 4. API y Puntos de Entrada

### 4.1 Rutas Principales

| Método | URI | Controlador | Función |
|--------|-----|-------------|---------|
| GET | / | PublicoController@inicio | Página principal |
| GET | /novelas | NovelaController@index | Listar novelas del usuario |
| GET | /novelas/create | NovelaController@create | Formulario de creación |
| POST | /novelas | NovelaController@store | Guardar nueva novela |
| GET | /novelas/{novela}/capitulos | CapituloController@index | Listar capítulos |
| POST | /capitulos/{capitulo}/like | CapituloInteraccionController@toggleLike | Dar/quitar "me gusta" |

### 4.2 Middlewares

- **auth**: Verificación de autenticación
- **verified**: Verificación de email
- **admin**: Restricción para administradores

## 5. Seguridad

### 5.1 Autenticación y Autorización

- Autenticación basada en Laravel Breeze
- Sistema de roles básico (usuario/administrador)
- Políticas de autorización por recurso

### 5.2 Protección de Datos

- Validación de formularios en servidor
- Protección CSRF en todos los formularios
- Almacenamiento seguro de contraseñas con bcrypt
- Sanitización de entrada de datos

### 5.3 Manejo de Sesiones

- Sesiones con tiempo de expiración
- Rotación de tokens CSRF
- Opción "recordarme" para prolongar sesiones
