<?php

namespace SoftC\Admin\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

use SoftC\Admin\Exceptions\Handler;;
use SoftC\Admin\Http\Middleware\Bouncer as BouncerMiddleware;
use SoftC\Admin\Http\Middleware\Locale;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        $router->aliasMiddleware('user', BouncerMiddleware::class);

        $router->aliasMiddleware('admin_locale', Locale::class);

        include __DIR__.'/../Http/helpers.php';
    }
}