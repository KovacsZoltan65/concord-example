<?php

namespace SoftC\Person\Repositories;

use SoftC\Core\Eloquent\Repository;

class PersonRepository extends Repository
{
    protected $fieldSearchable = ['name', 'email', 'phone'];

    public function model()
    {
        return 'Webkul\Person\Contracts\Person';
    }
}