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

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ReviewController@index');

Route::group(['prefix' => 'review'], function() {
    Route::get('search', 'ReviewController@search');
    Route::post('search', 'ReviewController@search');
    Route::get('info', 'ReviewController@info');
    Route::get('add', 'ReviewController@add')->middleware('auth');
    Route::get('edit', 'ReviewController@edit')->middleware('auth');
    Route::get('delete', 'ReviewController@delete')->middleware('auth');
    Route::post('create', 'ReviewController@create')->middleware('auth');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('info', 'ProfileController@info')->name('profile.info');
    Route::get('edit', 'ProfileController@edit')->middleware('auth');
    Route::post('update', 'ProfileController@update')->middleware('auth');
});

Route::group(['prefix' => 'ajax', 'middleware' => 'auth'], function() {
    Route::post('rateit', 'Ajax\EvaluationController@rateit');
    Route::get('getrate', 'Ajax\EvaluationController@getrate');
    Route::post('report', 'Ajax\EvaluationController@report');
    Route::post('autocomp', 'Ajax\AutocompController@autocomp');
    Route::post('select', 'Ajax\AutocompController@select');
});

Route::group(['prefix' => 'admin', 'middleware' => 'can:admin'], function() {
    Route::get('/', 'Admin\ReviewController@index');
    Route::group(['prefix' => 'review'], function() {
        Route::get('add', 'Admin\ReviewController@add');
        Route::post('update', 'Admin\ReviewController@update');
        Route::get('delete', 'Admin\ReviewController@delete');
        Route::get('info', 'Admin\ReviewController@info');
    });
    Route::group(['prefix' => 'game'], function() {
        Route::get('info', 'Admin\GameController@info');
        Route::get('edit', 'Admin\GameController@edit');
        Route::post('update', 'Admin\GameController@update');
        Route::get('delete', 'Admin\GameController@delete');
        Route::post('search', 'Admin\GameController@search');
        Route::get('search', 'Admin\GameController@search');
    });
    Route::group(['prefix' => 'profile'], function() {
        Route::get('info', 'Admin\ProfileController@info');
    });
});

Auth::routes();
