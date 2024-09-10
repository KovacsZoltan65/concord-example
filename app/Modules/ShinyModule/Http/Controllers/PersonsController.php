<?php

namespace App\Modules\ShinyModule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonsController extends Controller
{
    public function index(){
        //return 'Shiny Controller';
        return view('softc::persons.index');
    }
}
