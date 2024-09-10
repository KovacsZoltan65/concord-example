<?php

use App\Modules\ShinyModule\Http\Controllers\PersonsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/shiny', function () {
    //return view('shiny');
    //return 'hello shiny';
//});

Route::get('/shiny', [PersonsController::class, 'index']);