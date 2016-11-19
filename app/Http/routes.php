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


Route::get('/test', 'HomeController@test');
// Route::get('/test', function () {
//     return view('test');
// });

Route::get('/', 'HomeController@welcome');
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('exp', 'ExpController');
Route::group(['middleware' => 'auth'], function()
{
	Route::resource('exp', 'ExpController');
	// User's addresses   OH Yeah !!!
	// ex: /exp/{id}/photo
	Route::resource('exp.photo', 'PhotoController');
	//on enchaine les pages ex : exp/{id}/photo/{id}/hotspot
	Route::resource('exp.photo.hotspot', 'HotspotController');
});





//test de page controller, middelware; redirection et renommer
// Route::post('cover', 'ExtraController@cover')->name('cover');
Route::post('cover', ['uses' => 'ExtraController@cover', 'as' => 'cover', 'middleware' => 'auth']);
Route::post('quartz', ['uses' => 'ExtraController@quartz', 'as' => 'quartz', 'middleware' => 'auth']);
Route::get('/quartz.xml', 'ExtraController@xml');

// Route::get('quartz', 'ExtraController@quartz')->name('quartz');
// Route::get('quartz', ['uses' => 'ExtraController@quartz', 'as' => 'quartz', 'middleware' => 'auth']);
// Route::get('hotspot', 'ExtraController@create');
// Route::get('demo', 'ExtraController@demo2');
// Route::get('test', 'ExtraController@carousel');
// Route::get('demo2', ['uses' => 'ExtraController@demo2', 'as' => 'cover', 'middleware' => 'auth']);
// Route::get('demo2', 'ExtraController@demo2');
// Route::get('cover', 'ExtraController@cover');
// Route::post('upload', 'PhotoController@upload');
// Route::get('gallery', 'PhotoController@demo');
// Route::get('exp.{$n}.index', 'PhotoController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
