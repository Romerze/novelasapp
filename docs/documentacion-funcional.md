# Documentación Funcional - Sistema NovelasApp

## 1. Introducción al Sistema

### 1.1 Descripción General

NovelasApp es una plataforma web especializada para la creación, publicación y lectura de novelas en línea. El sistema permite a los escritores compartir sus obras por capítulos y a los lectores descubrir y seguir historias según sus géneros preferidos.

### 1.2 Propósito y Alcance

El propósito principal de NovelasApp es proporcionar un espacio donde:

- Los escritores puedan publicar sus novelas capítulo a capítulo
- Los lectores puedan descubrir y disfrutar de nuevas historias
- Se fomente la comunidad literaria mediante interacciones básicas
- Se mantenga un catálogo organizado por géneros literarios

### 1.3 Objetivos del Sistema

- Facilitar la creación y publicación de contenido literario
- Ofrecer una experiencia de lectura limpia y agradable
- Proporcionar herramientas para organizar y gestionar novelas
- Permitir la interacción básica entre usuarios y contenidos
- Establecer un sistema de categorización eficiente

## 2. Funcionalidades del Sistema

### 2.1 Módulo de Usuarios

#### 2.1.1 Registro e Inicio de Sesión

- **Registro de usuario**: Permite a visitantes crear una cuenta proporcionando nombre, correo electrónico y contraseña
- **Inicio de sesión**: Autentica usuarios mediante correo electrónico y contraseña
- **Recuperación de contraseña**: Permite restablecer contraseña vía email
- **Recordar sesión**: Opción para mantener la sesión activa entre visitas

#### 2.1.2 Gestión de Perfil

- **Ver perfil**: Visualización de datos personales y estadísticas
- **Editar perfil**: Actualización de datos personales
- **Cambiar contraseña**: Modificación de credenciales de acceso
- **Eliminar cuenta**: Opción para dar de baja la cuenta

### 2.2 Módulo de Novelas

#### 2.2.1 Gestión de Novelas

- **Creación de novela**: Formulario para introducir título, descripción, portada y géneros
- **Listado de novelas**: Vista con todas las novelas del usuario
- **Edición de novela**: Modificación de datos existentes
- **Eliminación de novela**: Opción para eliminar obra completa
- **Estadísticas**: Visualización de datos de lectura y engagement

#### 2.2.2 Exploración de Novelas

- **Catálogo general**: Listado de todas las novelas disponibles
- **Filtrado por género**: Visualización de novelas por categoría
- **Búsqueda por texto**: Localización de novelas por palabras clave
- **Novelas destacadas**: Selección de obras con mayor interacción

### 2.3 Módulo de Capítulos

#### 2.3.1 Gestión de Capítulos

- **Creación de capítulo**: Editor de texto enriquecido para nuevo contenido
- **Listado de capítulos**: Vista de todos los capítulos de una novela
- **Edición de capítulo**: Modificación de contenido existente
- **Eliminación de capítulo**: Opción para eliminar contenido
- **Ordenación de capítulos**: Sistema de numeración automática

#### 2.3.2 Lectura de Capítulos

- **Visualización de capítulo**: Interfaz de lectura limpia
- **Navegación entre capítulos**: Botones para capítulo anterior/siguiente
- **Interacción**: Opciones para guardar y dar "me gusta"
- **Capítulos guardados**: Lista de capítulos marcados para lectura posterior

### 2.4 Módulo de Géneros

- **Gestión de géneros**: Administración de categorías literarias
- **Asignación a novelas**: Relación de novelas con múltiples géneros
- **Exploración por género**: Navegación por categorías

### 2.5 Módulo de Interacción

- **Me gusta**: Opción para marcar capítulos favoritos
- **Guardar capítulo**: Función para guardar capítulos para lectura posterior
- **Capítulos guardados**: Listado de capítulos guardados por el usuario

### 2.6 Módulo de Imágenes

- **Subida de portadas**: Carga de imágenes para novelas
- **Imágenes en capítulos**: Inserción de imágenes en el contenido
- **Gestión de imágenes**: Organización y eliminación de recursos

## 3. Perfiles de Usuario

### 3.1 Tipos de Usuario

#### 3.1.1 Usuario Anónimo (No Registrado)

**Capacidades**:
- Navegar por novelas y capítulos públicos
- Ver detalles básicos de las novelas
- Leer capítulos publicados
- Registrarse en la plataforma

**Limitaciones**:
- No puede crear contenido
- No puede interactuar con el contenido existente
- No tiene acceso a funciones de guardar o dar "me gusta"

#### 3.1.2 Usuario Registrado (Autor/Lector)

**Capacidades**:
- Todas las funciones del usuario anónimo
- Crear y gestionar sus propias novelas
- Gestionar capítulos de sus novelas
- Dar "me gusta" a capítulos
- Guardar capítulos para lectura posterior
- Visualizar sus contenidos guardados
- Gestionar su perfil

**Limitaciones**:
- No puede modificar contenido de otros usuarios
- No tiene acceso a la gestión de géneros

#### 3.1.3 Administrador

**Capacidades**:
- Todas las funciones del usuario registrado
- Gestión de géneros literarios
- Acceso a estadísticas generales
- Gestión de usuarios y contenido

**Limitaciones**:
- No definidas (acceso completo)

## 4. Flujos de Trabajo

### 4.1 Creación de una Nueva Novela

1. El usuario inicia sesión en el sistema
2. Accede a la sección "Mis Novelas" en el dashboard
3. Hace clic en "Crear nueva novela"
4. Completa el formulario con título, descripción y géneros
5. Opcionalmente, sube una imagen de portada
6. Envía el formulario para crear la novela
7. Es redirigido a la página de detalles de la novela creada
8. Desde allí, puede empezar a crear capítulos

### 4.2 Publicación de un Capítulo

1. El usuario accede a una de sus novelas
2. Hace clic en "Añadir capítulo"
3. Introduce título y número de capítulo
4. Utiliza el editor para escribir el contenido
5. Opcionalmente, añade imágenes al contenido
6. Guarda el capítulo (como borrador o publicado)
7. Es redirigido a la vista de capítulos de la novela

### 4.3 Lectura y Guardado de Capítulos

1. El usuario navega por el catálogo o búsqueda
2. Selecciona una novela de interés
3. Visualiza los capítulos disponibles
4. Elige un capítulo para leer
5. Lee el contenido del capítulo
6. Puede dar "me gusta" o guardar el capítulo
7. Navega al siguiente capítulo o vuelve al listado

## 5. Interfaces de Usuario

### 5.1 Diseño General

La interfaz de NovelasApp sigue un diseño moderno y limpio, utilizando TailwindCSS para la maquetación y estilos. Los elementos visuales clave incluyen:

- Navegación intuitiva con menú principal y submenús contextuales
- Paneles de información con tarjetas para cada novela
- Formularios con validación en tiempo real
- Editor de texto enriquecido para creación de contenido
- Diseño responsivo adaptable a diferentes dispositivos

### 5.2 Pantallas Principales

#### 5.2.1 Dashboard

Panel central desde donde los usuarios acceden a:
- Listado de sus novelas
- Opción para crear nueva novela
- Acceso a capítulos guardados
- Estadísticas básicas de sus obras

#### 5.2.2 Listado de Novelas

Muestra las novelas disponibles con:
- Imagen de portada
- Título y descripción breve
- Géneros asociados
- Autor
- Estadísticas básicas (capítulos, lecturas)

#### 5.2.3 Editor de Capítulos

Interfaz para crear y editar capítulos con:
- Campo para título
- Editor TinyMCE para contenido enriquecido
- Herramientas para formateo de texto e inserción de imágenes
- Opciones para guardar como borrador o publicar

#### 5.2.4 Visualización de Capítulo

Interfaz de lectura con:
- Título del capítulo
- Contenido formateado
- Navegación entre capítulos
- Botones para interacción (me gusta, guardar)

## 6. Requisitos No Funcionales

### 6.1 Rendimiento

- Tiempo de carga de página inferior a 3 segundos
- Soporte para almacenamiento de imágenes optimizado
- Capacidad para manejar al menos 100 usuarios concurrentes

### 6.2 Seguridad

- Autenticación segura con Laravel Breeze
- Protección contra ataques CSRF
- Validación de datos en formularios
- Almacenamiento seguro de contraseñas con hash

### 6.3 Usabilidad

- Interfaz intuitiva y accesible
- Diseño responsivo para diferentes dispositivos
- Mensajes de error claros y orientativos
- Ayudas contextuales en formularios complejos

### 6.4 Escalabilidad

- Estructura modular para facilitar expansión
- Base de datos optimizada para crecimiento
- Arquitectura preparada para añadir nuevas funcionalidades
