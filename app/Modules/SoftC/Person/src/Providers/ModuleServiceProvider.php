<?php

namespace Softc\Person\Providers;

use SoftC\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \SoftC\Person\Models\Person::class,
    ];
}