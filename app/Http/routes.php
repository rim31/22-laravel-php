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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('exp', 'ExpController');

// User's addresses   OH Yeah !!!
// ex: /exp/{id}/photo
Route::resource('exp.photo', 'PhotoController');
// Route::resource('photo', 'PhotoController');



Route::get('hotspot', 'HotspotController@create');
// Route::get('exp/hotspot', 'HotspotController@create');
Route::post('upload', 'PhotoController@upload');
Route::get('gallery', 'PhotoController@demo');
Route::get('exp.{$n}.index', 'PhotoController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
