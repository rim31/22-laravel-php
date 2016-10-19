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
Route::get('/', 'HomeController@welcome');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('exp', 'ExpController');

// User's addresses   OH Yeah !!!
// ex: /exp/{id}/photo
Route::resource('exp.photo', 'PhotoController');
// Route::resource('photo', 'PhotoController');
Route::post('exp.photo.cover', ['uses' => 'ExtraController@cover', 'as' => 'cover', 'middleware' => 'auth']);



Route::get('hotspot', 'HotspotController@create');
// Route::get('demo2', ['uses' => 'HotspotController@demo2', 'as' => 'cover', 'middleware' => 'auth']);

// Route::get('demo2', 'HotspotController@demo2');
Route::get('demo', 'HotspotController@demo');


Route::get('test', 'HotspotController@carousel');
// Route::get('cover', 'HotspotController@cover');

// Route::post('upload', 'PhotoController@upload');
// Route::get('gallery', 'PhotoController@demo');
// Route::get('exp.{$n}.index', 'PhotoController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
