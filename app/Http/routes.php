<?php

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
Route::get('/', 'PagesController@home');



// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');


Route::resource('flyers', 'FlyersController');
Route::resource('{zip}/{street}', 'FlyersController@show');
/** refactored Route::resource('{zip}/{street}/photos', 'FlyersController@addPhoto');*/
Route::resource('{zip}/{street}/photos', 'FlyerPhotoController@store');