<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() 
{
    return view('home');
})->name('home');

Route::get('/documentation', function()
{
    return view('documentation');
})->name('documentation');
