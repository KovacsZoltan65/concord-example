<?php

namespace SoftC\Person\Models;

use SoftC\Person\Contracts\Person as PersonContract;

class Person implements PersonContract
{
    protected $table = 'persons';

    protected $fillable = [
        'name', 'email', 'phone'
    ];
}
