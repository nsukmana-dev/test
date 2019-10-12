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

Route::get('/', function () {
    return view('index');
});

Route::post('regis', 'registrasi@regis');
Route::post('cekemail', 'registrasi@cekemail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
