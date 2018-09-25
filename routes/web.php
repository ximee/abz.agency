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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'PageController@mainPage');

Route::get('guest-fetch-roots', 'PageController@fetchRoots');

Route::get('guest-fetch-children/{id}', 'PageController@fetchChildren');

Route::get('auth-fetch-roots', 'HomeController@fetchRoots');

Route::get('auth-fetch-children/{id}', 'HomeController@fetchChildren');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
