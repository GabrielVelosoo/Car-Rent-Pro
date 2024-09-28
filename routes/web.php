<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() 
{
<<<<<<< HEAD
    return view('site.home');
=======
    return view('home');
>>>>>>> 158757e275c3f9725f6291318b9c3dc5d4a388e8
})->name('home');

Route::get('/documentation', function()
{
<<<<<<< HEAD
    return view('site.documentation');
=======
    return view('documentation');
>>>>>>> 158757e275c3f9725f6291318b9c3dc5d4a388e8
})->name('documentation');
