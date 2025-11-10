# CineApp

Sistema de gestión de cine desarrollado con Laravel 11, que permite administrar películas, funciones, salas y ventas de boletos.

## Descripción

CineApp es una aplicación web completa para la gestión de un cine, que incluye:

-   **Gestión de películas**: CRUD completo con imágenes y trailers de YouTube
-   **Gestión de salas**: Diferentes tipos de salas (2D, 3D, IMAX, VIP)
-   **Gestión de funciones**: Horarios y precios por función
-   **Sistema de reservas**: Selección interactiva de asientos
-   **Sistema de ventas**: Registro de ventas y métodos de pago
-   **Control de acceso por roles**: Admin, Cajero y Cliente

## Características

### Roles de Usuario

-   **Administrador**: Acceso completo a todas las funcionalidades
-   **Cajero**: Gestión de ventas y visualización de datos
-   **Cliente**: Acceso a cartelera y sistema de reservas

### Funcionalidades Principales

-   Cartelera interactiva con información de películas
-   Reproducción de trailers integrados de YouTube
-   Selección visual de asientos en tiempo real
-   Gestión de asientos ocupados y disponibles
-   Dashboard con estadísticas del sistema
-   Sistema de autenticación con Laravel Breeze
-   Interfaz responsive con Tailwind CSS

## Tecnologías

-   **Backend**: Laravel 11
-   **Frontend**: Blade, Tailwind CSS, JavaScript
-   **Base de datos**: MySQL
-   **Autenticación**: Laravel Breeze
-   **Build**: Vite
-   **PHP**: 8.2+

## Instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/eddyNTR/cineapp.git
cd cineapp
```

2. **Instalar dependencias de PHP**

```bash
composer install
```

3. **Instalar dependencias de Node.js**

```bash
npm install
```

4. **Configurar el archivo .env**

```bash
cp .env.example .env
```

Editar el archivo `.env` con la configuración de tu base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cineapp
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generar la clave de la aplicación**

```bash
php artisan key:generate
```

6. **Ejecutar las migraciones**

```bash
php artisan migrate
```

7. **Ejecutar los seeders (opcional)**

```bash
php artisan db:seed --class=AdminSeeder
```

Esto creará los siguientes usuarios de prueba:

-   **Admin**: admin@cineapp.com / password
-   **Cajero**: cajero@cineapp.com / password
-   **Cliente**: cliente@cineapp.com / password

8. **Crear enlace simbólico para el storage**

```bash
php artisan storage:link
```

9. **Compilar assets**

```bash
npm run dev
```

10. **Iniciar el servidor**

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## Estructura del Proyecto

```
cineapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── PeliculaController.php
│   │   │   ├── FuncionController.php
│   │   │   ├── SalaController.php
│   │   │   ├── VentaController.php
│   │   │   └── ReservaController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── Pelicula.php
│       ├── Sala.php
│       ├── Funcion.php
│       ├── Reserva.php
│       ├── Venta.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── dashboard/
│   │   ├── peliculas/
│   │   ├── funciones/
│   │   ├── salas/
│   │   ├── ventas/
│   │   ├── reservas/
│   │   └── layouts/
│   ├── css/
│   └── js/
└── routes/
    ├── web.php
    └── api.php
```

## Base de Datos

### Tablas Principales

-   **users**: Usuarios del sistema con roles
-   **peliculas**: Información de películas (título, género, duración, sinopsis, imagen, trailer)
-   **salas**: Salas del cine (nombre, tipo, capacidad)
-   **funciones**: Horarios de proyección (fecha, hora, precio)
-   **reservas**: Reservas de boletos
-   **ventas**: Registro de ventas realizadas

## Sistema de Roles

El sistema implementa middleware personalizado para control de acceso:

```php
// Rutas protegidas por rol
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Acceso solo para administradores
});

Route::middleware(['auth', 'role:cajero'])->group(function () {
    // Acceso solo para cajeros
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    // Acceso solo para clientes
});
```

## Uso

### Para Administradores

1. Iniciar sesión con credenciales de administrador
2. Acceder al dashboard para ver estadísticas
3. Gestionar películas, salas y funciones
4. Ver reportes de ventas

### Para Cajeros

1. Iniciar sesión con credenciales de cajero
2. Acceder al módulo de ventas
3. Registrar ventas de boletos
4. Consultar funciones disponibles

### Para Clientes

1. Registrarse o iniciar sesión
2. Explorar la cartelera de películas
3. Ver trailers y detalles de películas
4. Seleccionar función y asientos
5. Confirmar reserva

## Personalización

### Agregar Trailers de YouTube

1. Ir a la película en YouTube
2. Copiar el ID del video (parte después de `v=` en la URL)
3. Ejemplo: `https://www.youtube.com/watch?v=dQw4w9WgXcQ` → ID: `dQw4w9WgXcQ`
4. Pegar el ID en el campo "Trailer" al crear/editar película

## Licencia

Este proyecto está bajo la licencia MIT.

## Autor

**Eddy NTR**

-   GitHub: [@eddyNTR](https://github.com/eddyNTR)

---
