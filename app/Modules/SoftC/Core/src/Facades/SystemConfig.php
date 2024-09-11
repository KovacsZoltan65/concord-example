<?php

namespace SoftC\Core\Facades;

use Illuminate\Support\Facades\Facade;

class SystemConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'system_config';
    }
}