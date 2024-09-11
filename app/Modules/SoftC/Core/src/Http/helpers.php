<?php

use SoftC\Core\Core;
use SoftC\Core\Acl;
use SoftC\Core\ViewRenderEventManager;

if (! function_exists('core')) {
    /**
     * Core helper.
     */
    function core(): Core
    {
        return app('core');
    }
}

if (! function_exists('menu')) {
    /*
    function menu(): Menu
    {
        return app('menu');
    }
    */
}

if (! function_exists('acl')) {
    /**
     * Acl helper.
     */
    function acl(): Acl
    {
        return app('acl');
    }
}

if (! function_exists('system_config')) {
    /**
     * System Config helper.
     */
    function system_config(): SystemConfig
    {
        return app('system_config');
    }
}

if (! function_exists('view_render_event')) {
    /**
     * View render event helper.
     */
    function view_render_event($eventName, $params = null)
    {
        app()->singleton(ViewRenderEventManager::class);

        $viewEventManager = app()->make(ViewRenderEventManager::class);

        $viewEventManager->handleRenderEvent($eventName, $params);

        return $viewEventManager->render();
    }
}

if (! function_exists('vite')) {
    /**
     * Vite helper.
     */
    function vite(): Vite
    {
        return app(Vite::class);
    }
}