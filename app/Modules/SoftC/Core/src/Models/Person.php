<?php

namespace SoftC\Core\Models;
use Illuminate\Database\Eloquent\Model;
use SoftC\Core\Contracts\CoreConfig as CoreConfigContract;

class Person extends Model implements CoreConfigContract
{
    protected $table = '';
}
