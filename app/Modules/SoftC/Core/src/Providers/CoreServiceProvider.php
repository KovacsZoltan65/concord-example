<?php

namespace SoftC\Core\Providers;

use Illuminate\Support\ServiceProvider;
use SoftC\Core\Facades\Core as CoreFacade;;

class CoreServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        include __DIR__ . '/../Http/helpers.php';
        
        $this->loadMigrationsFrom( __DIR__ . '/../Database/Migrations' );
        $this->loadTranslationsFrom( __DIR__ . '/../Resources/lang' , 'softc');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'softc');
        $this->publishes([
            dirname(__DIR__) . '/Config/softc.php' => config_path('softc.php'),
            dirname(__DIR__) . '/Config/cors.php' => config_path('cors.php'),
            dirname(__DIR__) . '/Config/sanctum.php' => config_path('sanctum.php'),
        ]);
    }
    
    public function register(): void {
        $this->registerCommands();
        $this->registerFacades();
    }
    
    protected function registerFacades(): void {
        $loader = AliasLoader::getInstance();
        
        $loader->alias('core', CoreFacade::class);
        
        $this->app->singleton('core', fn () => app(Core::class));
    }
    
    protected function registerCommands(): void {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Version::class,
            ]);
        }
    }
}