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
    Route::match(['get', 'post'], 'survey', 'AdminController@survey');
    Route::match(['get', 'post'], 'question/{sid}', 'AdminController@question');
    Route::match(['get', 'post'], 'editSurvey/{id}', 'AdminController@editSurvey');
    Route::match(['get', 'post'], 'editQuestion/{id}', 'AdminController@editQuestion');
    Route::post('delete', 'AdminController@delete');
    Route::get('getip', 'AdminController@getip');
});

Route::group(['prefix' => 'chrome', 'namespace' => 'Chrome'], function () {
    Route::match(['get', 'post'], 'addQuestion/{sid}', 'SurveyController@addQuestion');
    Route::match(['get', 'post'], 'addSurvey', 'SurveyController@addSurvey');
    Route::match(['get', 'post'], 'selectSurvey', 'SurveyController@selectSurvey');
    Route::match(['get', 'post'], 'searchSurvey', 'SurveyController@searchSurvey');
    Route::match(['get', 'post'], 'findQuestion', 'SurveyController@findQuestion');
});