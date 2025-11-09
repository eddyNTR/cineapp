<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\FuncionController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\LandingController;

// Página principal (cartelera pública)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Rutas protegidas por login
Route::middleware(['auth'])->group(function () {

    // 🧮 Panel del administrador
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('peliculas', PeliculaController::class);
        Route::resource('funciones', FuncionController::class)->parameters(['funciones' => 'funcion']);
        Route::resource('salas', SalaController::class);
        Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'user']);
        Route::get('/configuracion', [ConfigController::class, 'index'])->name('configuracion');
    });

    // 💵 Módulo de ventas (cajeros y administradores
    Route::middleware('role:cajero|admin')->group(function () {
        Route::resource('ventas', VentaController::class);
    });

    // 🎟️ Módulo de reservas (solo clientes)
    Route::middleware('role:cliente')->group(function () {
        // Ruta para ver la cartelera de películas
        Route::get('/cartelera', [ReservaController::class, 'index'])->name('cartelera');
        Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar');
        // Mostrar la reserva de la película seleccionada con los horarios
        Route::get('/reservar', [ReservaController::class, 'show'])->name('reservar');
        Route::get('/seleccionar-asiento/{funcion_id}', [ReservaController::class, 'selectSeat'])->name('seleccionar-asiento');
        Route::get('/asiento/{funcion}', [ReservaController::class, 'selectSeat'])->name('asiento');
        Route::get('/reserva/{reserva}', [ReservaController::class, 'confirmacion'])->name('reserva.confirmacion');
    });
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Ruta para seleccionar asiento
    Route::get('/asiento/{funcion}', [ReservaController::class, 'selectSeat'])->name('asiento');
    Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar.store');
});