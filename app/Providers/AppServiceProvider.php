<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Compra;
use App\Models\Despacho;
use App\Observers\CompraObserver;
use App\Observers\DespachoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Compra::observe(CompraObserver::class);
        Despacho::observe(DespachoObserver::class);
       // Paginator::useBootstrapFive(); // Agrega esta línea para usar el estilo de Bootstrap en la paginación
    }
}
