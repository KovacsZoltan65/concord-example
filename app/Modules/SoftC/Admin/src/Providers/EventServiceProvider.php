<?php

namespace SoftC\Admin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*
        'contacts.person.create.after' => [
            'SoftC\Admin\Listeners\Person@linkToEmail',
        ],

        'lead.create.after' => [
            'SoftC\Admin\Listeners\Lead@linkToEmail',
        ],

        'activity.create.after' => [
            'SoftC\Admin\Listeners\Activity@afterUpdateOrCreate',
        ],

        'activity.update.after' => [
            'SoftC\Admin\Listeners\Activity@afterUpdateOrCreate',
        ],
        */
    ];
}