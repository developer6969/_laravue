<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login related routes
Auth::routes();



// Default Screen on Launch of Domain [Status LOGGED-OUT]
Route::get('/', function () {
    return view('welcome');
});

// Default Screen on Launch of Domain [Status LOGGED-IN]
Route::get('/home', 'HomeController@index')->name('home');




// Launch on click of dashboard
// All other routes in from here onwards will be Vue-Routes
// and are registered in resources/js/app.js file
Route::get('/dashboard', function() {
    return view('master');
});




// SETTING Default Page By Laravel

// OPTION 1 :
// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

// OPTION 2 :
Route::fallback(function () {
    return view('home');
});