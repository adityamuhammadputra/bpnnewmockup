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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//warkah
Route::resource('/datawarkah','WarkahController')->except(['create']);
Route::get('api/warkah','WarkahController@apiWarkah')->name('api.warkah');

//ptsl
Route::resource('/dataptsl','PtslController');
Route::get('api/ptsl','PtslController@apiPtsl')->name('api.ptsl');

//user
Route::resource('user', 'UserController');
Route::get('api/user','UserController@apiUser')->name('api.user');
