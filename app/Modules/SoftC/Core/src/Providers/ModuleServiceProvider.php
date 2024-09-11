<?php

namespace SoftC\Core\Providers;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \SoftC\Core\Models\CoreConfig::class,
    ];
}