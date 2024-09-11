<?php

namespace Softc\Person\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider
{
    //
    public function boot(Router $router): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function register() {}
    
}