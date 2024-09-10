<?php

namespace SoftC\Person\Providers;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider
{
    public function boot(RouteRegistrar $router)
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function register() {}
}
