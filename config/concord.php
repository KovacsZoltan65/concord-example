<?php

return [
    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */
        App\Modules\ShinyModule\Providers\ModuleServiceProvider::class => [
            'views' => [
                'namespace' => 'softc'
            ]
        ],
    ],
    'register_route_models' => true
];
