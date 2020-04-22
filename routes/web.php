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


Route::get('/', 'CounterController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/updateCounter', 'CounterController@updateCounter')->name('updateCounter');
Route::get('/getLatestCount', 'CounterController@getLatestCount')->name('getLatestCount');
Route::post('/resetCounter', 'CounterController@resetCounter')->name('resetCounter');

Route::get('/show', 'CounterController@show')->name('show');


