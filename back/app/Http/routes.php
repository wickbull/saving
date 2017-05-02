<?php

LaravelGettext::setLocale('uk_UA');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'control', 'uses' => 'HomeController@getIndex', 'protected' => true]);

Route::get('/ajax-sliders', 'HomeController@getSliders');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
