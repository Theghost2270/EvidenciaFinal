<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define tu espacio de controlador raíz.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Ruta hacia la "home" después del login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Registro de rutas
     */
    public function boot()
    {
        parent::boot();

        $this->routes(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        });
    }
}