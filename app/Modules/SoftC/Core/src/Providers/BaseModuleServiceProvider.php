<?php

namespace SoftC\Core\Providers;

use Konekt\Concord\BaseModuleServiceProvider as ConcordBaseModuleServiceProvider;

class BaseModuleServiceProvider extends ConcordBaseModuleServiceProvider
{
    public function boot()
    {
        if ($this->areMigrationsEnabled()) {
            //$this->registerMigrations();
            \Log::info('Register Migrations');
        }

        if ($this->areModelsEnabled()) {
            //$this->registerModels();
            //$this->registerEnums();
            //$this->registerRequestTypes();
            \Log::info('Register Models, Enums, RequestTypes');
        }

        if ($this->areViewsEnabled()) {
            //$this->registerViews();
            \Log::info('Register Views');
        }

        if ($routes = $this->config('routes', true)) {
            //$this->registerRoutes($routes);
            \Log::info('Register Routes');
        }
    }
}
