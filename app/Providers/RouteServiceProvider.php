<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * La ruta a la que Laravel redirige tras iniciar sesión.
     *
     * Puedes cambiar esto según tu preferencia.
     */
    public const HOME = '/dashboard';

    /**
     * Define las rutas de la aplicación.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
    public static function redirectToByRole($user)
    {   
        return match ($user->role) {
            'admin'   => '/dashboard',
            'cajero'  => '/ventas',
            'cliente' => '/cartelera',
            default   => '/',
        };
    }
}
