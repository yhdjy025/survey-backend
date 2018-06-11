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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Admin\AdminController@survey');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('survey', 'AdminController@survey');
    Route::get('question/{sid}', 'AdminController@question');

    Route::post('delete', 'AdminController@delete');
});
