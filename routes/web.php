<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() 
{
    return view('site.home');
})->name('home');

Route::get('/documentation', function()
{
    return view('site.documentation');
})->name('documentation');
